<?php

namespace App\Observers\OutgoingObserver;

use App\Models\OutgoingModel\OutgoingHistory;
use App\Models\OutgoingModel\OutgoingRegister;
use App\Models\OutgoingModel\Stamps\StampHistory;
use App\Models\OutgoingModel\Stamps\StampRegister;

class OutgoingRegisterObserver
{
    /**
     * Handle the OutgoingRegister "created" event.
     *
     * @param OutgoingRegister $outgoingRegister
     * @return void
     */
    public function created(OutgoingRegister $outgoingRegister)
    {
        OutgoingHistory::create([
            'outgoing_register_id' => $outgoingRegister->id,
            'employee_id' => $outgoingRegister->employee_id,
            'touched_fields' => json_encode([
                'is_created' => true,
            ], true)
        ]);
        $stamps = $outgoingRegister->stamps_used;
        foreach ($stamps as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamp->update(['count' => $stamp->count - $value['count']]);
        }
        StampHistory::create([
            'outgoing_register_id' => $outgoingRegister->id,
            'stamps' => $stamps,
        ]);
    }

    /**
     * Handle the OutgoingRegister "updated" event.
     *
     * @param OutgoingRegister $outgoingRegister
     * @return void
     */
    public function updated(OutgoingRegister $outgoingRegister)
    {
        if ($outgoingRegister->isDirty('stamps_used')) {
            $oldUsed = $outgoingRegister->getOriginal('stamps_used');
            $needleStamps = $outgoingRegister->stamps();
            foreach ($oldUsed as $key => $value) {
                $stamp = StampRegister::find($value['id']);
                $stamp->update(['count' => $stamp->count + $value['count']]);
            }
            foreach ($needleStamps as $key => $value) {
                $stamp = StampRegister::find($value['id']);
                $stamp->update(['count' => $stamp->count - $value['count']]);
            }
            $outgoingRegister->stampHistory->update(['stamps' => $outgoingRegister->stamps_used]);
        }
    }

    /**
     * Handle the OutgoingRegister "deleted" event.
     *
     * @param OutgoingRegister $outgoingRegister
     * @return void
     */
    public
    function deleted(OutgoingRegister $outgoingRegister)
    {
        OutgoingHistory::create([
            'outgoing_register_id' => $outgoingRegister->id,
            'touched_fields' => json_encode([
                'is_deleted' => true,
            ], true)
        ]);
        $stamps = $outgoingRegister->stamps_used;
        foreach ($stamps as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamp->update(['count' => $stamp->count + $value['count']]);
        }
        $outgoingRegister->stampHistory->update(['stamps' => []]);
    }

    /**
     * Handle the OutgoingRegister "restored" event.
     *
     * @param OutgoingRegister $outgoingRegister
     * @return void
     */
    public
    function restored(OutgoingRegister $outgoingRegister)
    {
        OutgoingHistory::create([
            'outgoing_register_id' => $outgoingRegister->id,
            'touched_fields' => json_encode([
                'is_restored' => true,
            ], true)
        ]);
        $stamps = $outgoingRegister->stamps_used;
        foreach ($stamps as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamp->update(['count' => $stamp->count + $value['count']]);
        }
        $outgoingRegister->stampHistory->update(['stamps' => $outgoingRegister->stamps_used]);
    }

    /**
     * Handle the OutgoingRegister "force deleted" event.
     *
     * @param OutgoingRegister $outgoingRegister
     * @return void
     */
    public
    function forceDeleted(OutgoingRegister $outgoingRegister)
    {
        $stamps = $outgoingRegister->stamps_used;
        foreach ($stamps as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamp->update(['count' => $stamp->count + $value['count']]);
        }
        $outgoingRegister->stampHistory->forceDelete();
        $outgoingRegister->history->forceDelete();
    }
}
