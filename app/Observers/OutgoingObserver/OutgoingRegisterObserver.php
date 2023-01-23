<?php

namespace App\Observers\OutgoingObserver;

use App\Models\OutgoingModel\OutgoingHistory;
use App\Models\OutgoingModel\OutgoingRegister;
use App\Models\OutgoingModel\Stamps\StampBalance;
use App\Models\OutgoingModel\Stamps\StampHistory;
use Error;
use Illuminate\Support\Facades\Log;

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
        $balance = StampBalance::orderby('id', 'desc')->first()->balance;
        foreach ($stamps as $key => $value) {
            $balance[$value['id']] -= $value['count'];
        }
        StampBalance::create([
            'employee_id' => $outgoingRegister->employee->id,
            'type' => false,
            'balance' => $balance,
        ]);
        StampHistory::create([
            'outgoing_register_id' => $outgoingRegister->id,
            'stamps_used' => $outgoingRegister->stamps_used,
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
            $isArrived = false;
            $isUsed = false;
            $balance = StampBalance::orderby('id', 'desc')->first()->balance;
            $oldStamps = $outgoingRegister->getOriginal('stamps_used');
            $currentStamps = $outgoingRegister->stamps_used;
            foreach ($currentStamps as $key => $value) {
                if ($value['count'] < $oldStamps[$value['id']]['count']) { //Вернуть в реестр
                    $different = $oldStamps[$value['id']]['count'] - $value['count'];
                    $balance[$value['id']] += $different;
                    $isArrived = true;
                } elseif ($value['count'] > $oldStamps[$value['id']]['count']) { //Забрать из реестра
                    $different = $value['count'] - $oldStamps[$value['id']]['count'];
                    $balance[$value['id']] -= $different;
                    $isUsed = true;
                }
            }
            if ($isArrived) {
                StampBalance::create([
                    'employee_id' => $outgoingRegister->employee->id,
                    'type' => true,
                    'balance' => $balance,
                ]);
            }
            if ($isUsed) {
                StampBalance::create([
                    'employee_id' => $outgoingRegister->employee->id,
                    'type' => false,
                    'balance' => $balance,
                ]);
            }
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
            'employee_id' => $outgoingRegister->employee_id,
            'touched_fields' => json_encode([
                'is_deleted' => true,
            ], true)
        ]);
        $stamps = $outgoingRegister->stamps_used;
        $balance = StampBalance::orderby('id', 'desc')->first()->balance;
        foreach ($stamps as $key => $value) {
            $balance[$value['id']] += $value['count'];
        }
        StampBalance::create([
            'employee_id' => $outgoingRegister->employee->id,
            'type' => true,
            'balance' => $balance,
        ]);
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
            'employee_id' => $outgoingRegister->employee_id,
            'touched_fields' => json_encode([
                'is_restored' => true,
            ], true)
        ]);
        $stamps = $outgoingRegister->stamps_used;
        $balance = StampBalance::orderby('id', 'desc')->first()->balance;
        foreach ($stamps as $key => $value) {
            $balance[$value['id']] -= $value['count'];
        }
        StampBalance::create([
            'employee_id' => $outgoingRegister->employee->id,
            'type' => false,
            'balance' => $balance,
        ]);
        StampHistory::create([
            'outgoing_register_id' => $outgoingRegister->id,
            'stamps_used' => $outgoingRegister->stamps_used,
        ]);
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
        $outgoingRegister->history->forceDelete();
        $stamps = $outgoingRegister->stamps_used;
        $balance = StampBalance::orderby('id', 'desc')->first()->balance;
        foreach ($stamps as $key => $value) {
            $balance[$value['id']] += $value['count'];
        }
        StampBalance::create([
            'employee_id' => $outgoingRegister->employee->id,
            'type' => true,
            'balance' => $balance,
        ]);
    }
}
