<?php


namespace App\Http\Controllers\OutgoingController\Stamps;


use App\Models\OutgoingModel\Stamps\StampHistory;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

trait TotalPrice
{

    /**
     * Получить количество марок и общую стоимость в записи истории
     * @param StampHistory|JsonResource $history
     * @return array
     */
    #[ArrayShape(['total' => "int|mixed", 'price' => "float|int"])]
    public function totalPrice(StampHistory | JsonResource $history): array
    {
        $stampsCount = 0;
        $stampsPrice = 0;
        foreach ($history->stamps as $key => $value) {
            $stampsCount += $value['count'];
            $stamp = StampRegister::find($value['id']);
            $stampsPrice += $value['count'] * $stamp->value;
        }
        return [
            'total' => $stampsCount,
            'price' => $stampsPrice
        ];
    }

}
