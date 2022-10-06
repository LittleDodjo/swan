<?php

namespace App\Http\Controllers\Api\Subsystem\Outgoing;

use App\Http\Controllers\Controller;
use App\Models\Subsystem\Outgoing\OutDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Paginator;

class OutDocumentController extends Controller
{

    public $paginate = 5;
    /**
     * Получить список документов
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOutgoingDocuments(Request $request){
        $paginate = $this->paginate;
        $data = OutDocument::paginate($paginate);
        return response()->json([
            'data' => $data,
        ], 200);
    }


    public function createOutgoingDocument(Request $request){
        $data = new OutDocument(
            $request->toArray()
        );
        $data->save();
        return response([
            'status' => true,
            'message' => "Документ создан",
            'data' => $data,
        ], 200);
    }

    public function changeOutgoingDocument(Request $request){

    }

    public function removeOutgoingDocument(Request $request){

    }
}
