<?php

namespace App\Http\Resources\Subsystem;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OutDocumentResourceCollection extends ResourceCollection
{


    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'count' => $this->count(),
                'currentPage' => $this->currentPage(),
                'totalPage' => $this->lastPage(),
                'nextPage' => $this->nextPageUrl(),
                'prevPage' => $this->previousPageUrl()
            ]
        ];
    }
}
