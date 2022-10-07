<?php

namespace App\Http\Controllers\Api\Subsystem\Outgoing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Subsystem\OutDocumentResource;
use App\Http\Resources\Subsystem\OutDocumentResourceCollection;
use App\Models\Subsystem\Outgoing\OutDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class OutDocumentController extends Controller
{

    public $paginate = 5;


    public function __construct()
    {
        $this->authorizeResource(OutDocument::class, 'OutDocument');
    }

    /**
     * Получить список документов
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOutgoingDocuments(Request $request){
        if($this->isAuthorize()) {
            $r = new OutDocumentResourceCollection(
                OutDocument::paginate(2)
            );
            return response()->json([$r], 200);
        }
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
