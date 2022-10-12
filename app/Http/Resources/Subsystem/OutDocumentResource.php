<?php

namespace App\Http\Resources\Subsystem;

use Illuminate\Http\Resources\Json\JsonResource;

class OutDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'executor_id' => $this->executor_id,
            'department_id' => $this->department_id,
            'out_correspondent_id' => $this->out_correspondent_id,
            'out_correspondent_date' => $this->out_correspondent_date,
            'document_type' => $this->document_type,
            'departure_type' => $this->departure_type,
            'departure_view' => $this->departure_view,
            'departure_date' => $this->departure_date,
            'departure_email_date' => $this->departure_email_date,
            'outgoing_number' => $this->outgoing_number,
            'outgoing_date' => $this->outgoing_date,
            'lists_count' => $this->lists_count,
            'where_directed' => $this->where_directed,
            'recipient' => $this->recipient,
            'address' => $this->address,
            'document_content' => $this->document_content,
            'count_of_instances' => $this->count_of_instances,
            'count_of_envelopes' => $this->count_of_envelopes,
            'envelope_type' => $this->envelope_type,
            'brand_price' => $this->brand_price,
            'history' => $this->hasHistory,
        ];
    }

}
