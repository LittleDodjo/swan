<?php

namespace App\Models\Subsystem\Outgoing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutDocument extends Model
{
    use HasFactory;


    protected $table = 'outgoing_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'executor_id',
        'department_id',
        'out_correspondent_id',
        'out_correspondent_date',
        'document_type',
        'departure_type',
        'departure_view',
        'departure_date',
        'departure_email_date',
        'outgoing_number',
        'outgoing_date',
        'lists_count',
        'where_directed',
        'recipient',
        'address',
        'document_content',
        'count_of_instances',
        'count_of_envelopes',
        'envelope_type',
        'brand_price',
    ];
}
