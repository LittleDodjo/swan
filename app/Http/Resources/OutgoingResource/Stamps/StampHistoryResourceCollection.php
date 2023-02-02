<?php

namespace App\Http\Resources\OutgoingResource\Stamps;

use App\Models\OutgoingModel\Stamps\StampHistory;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

/**
 * @method currentPage()
 * @method lastPage()
 */
class StampHistoryResourceCollection extends ResourceCollection
{

    public $collects = StampHistoryResource::class;

    /**
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['data' => "array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable", 'page' => "", 'total' => ""])] public function toArray($request): array
    {
        return [
            'data' => parent::toArray($request),
            'page' => $this->currentPage(),
            'total' => $this->lastPage(),
        ];
    }
}
