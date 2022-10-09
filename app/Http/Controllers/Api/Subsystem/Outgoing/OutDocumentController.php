<?php

namespace App\Http\Controllers\Api\Subsystem\Outgoing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Subsystem\OutDocumentResource;
use App\Http\Resources\Subsystem\OutDocumentResourceCollection;
use App\Models\Subsystem\Outgoing\OutDocHistory;
use App\Models\Subsystem\Outgoing\OutDocument;
use App\Models\Subsystem\SubsystemHelper;
use Illuminate\Http\Request;


class OutDocumentController extends Controller
{
    use SubsystemHelper;

    /**
     * уровень пагинации
     * @var int
     */
    public $paginate = 5;
    /**
     * префикс
     * @var string
     */
    public $subsystemPrefix = "Исходящие";


    /**
     * авторизация ресурсов
     */
    public function __construct()
    {
        $this->authorizeResource(OutDocument::class, 'OutDocument');
    }

    /**
     * Получить список документов
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOutgoingDocuments(Request $request)
    {
        $result = $this->subsystemAccess(OutDocument::class, 'viewAny');
        if($result !== true) return $result;
        $documentList = new OutDocumentResourceCollection(
            OutDocument::paginate($this->paginate)
        );
        return response()->json([$documentList] ,200);
    }


    /**
     * получить документ по id
     * @param Request $request
     * @param $id
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function getOutgoingDocument(Request $request, $id){
        $result = $this->subsystemAccess(OutDocument::class, 'view');
        if($result !== true) return $result;
        if(!$this->subjectExists(OutDocument::class, $id)) {
            return response()->json([
                'message' => 'Такой документ не найден',
            ], 404);
        }
        $document = new OutDocumentResource(
            OutDocument::find($id)->first()
        );
        return  response()->json([
            'data' => $document,
        ], 200);
    }


    /**
     * Создать новый документ
     * @param Request $request
     * @return bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function createOutgoingDocument(Request $request)
    {
        $result = $this->subsystemAccess(OutDocument::class, 'create');
        if($result !== true) return $result;
        $document = new OutDocument(
            $request->toArray()
        );
        $document->save();
        return response([
            'status' => true,
            'message' => "Документ создан",
            'data' => $document,
        ], 200);
    }

    /**
     * Отредактировать существующий документ
     * @param Request $request
     * @return bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function changeOutgoingDocument(Request $request)
    {
        $result = $this->subsystemAccess(OutDocument::class, 'update');
        if($result !== true) return $result;
        if(!$this->checkValidateAndExists(OutDocument::class, $request)){
            return response()->json([
                'message' => $this->subsystemPrefix.': Такой документ не найден'
            ], 404);
        }
        $document = OutDocument::find($this->getKey($request));
        $document = $this->updateSubject($request, $document, OutDocHistory::class);
        if($result == false){
            return response([
                'message' => $this->subsystemPrefix.': Не удалось обновить документ'
            ], 422);
        }
        return response()->json([
            'message' => $this->subsystemPrefix.': документ №'. $document->id. ' успешно изменен',
            'data' => $document,
        ], 200);
    }

    /**
     * Удалить документ по id
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function removeOutgoingDocument(Request $request)
    {
        $result = $this->subsystemAccess(OutDocument::class, 'delete');
        if($result !== true) return $result;
        if(!$this->checkValidateAndExists(OutDocument::class, $request)){
            return response()->json([
                'message' => $this->subsystemPrefix.': Такой документ не найден'
            ], 404);
        }
        $document = OutDocument::find($this->getKey($request));
        $document = $this->deleteSubject($document, OutDocHistory::class);
        return response()->json([
            'message' => $this->subsystemPrefix.': Документ № '. $document . ' удален',
            'data' => $document,
        ], 200);
    }


}
