<?php

namespace App\Observers\Outgoing\Stamps;

use App\Models\OutgoingModel\Stamps\StampBalance;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class StampRegisterObserver
{
    /**
     * Handle the StampRegister "created" event.
     *
     * @param  \App\Models\OutgoingModel\Stamps\StampRegister  $stampRegister
     * @return void
     */
    public function created(StampRegister $stampRegister)
    {
        $balance = StampBalance::query()->latest()->first();
        $lastBalance = $balance->balance;
        $lastBalance[$stampRegister->id] = 0;
        $balance->balance = $lastBalance;
        $balance->save();
    }

    /**
     * Handle the StampRegister "updated" event.
     *
     * @param  \App\Models\OutgoingModel\Stamps\StampRegister  $stampRegister
     * @return void
     */
    public function updated(StampRegister $stampRegister)
    {

    }

    /**
     * Handle the StampRegister "deleted" event.
     *
     * @param  \App\Models\OutgoingModel\Stamps\StampRegister  $stampRegister
     * @return void
     */
    public function deleted(StampRegister $stampRegister)
    {
        $balance = StampBalance::query()->latest()->first();
        $lastBalance = $balance->balance;
        unset($lastBalance[$stampRegister->id]);
        $balance->balance = $lastBalance;
        $balance->save();
    }

    /**
     * Handle the StampRegister "restored" event.
     *
     * @param  \App\Models\OutgoingModel\Stamps\StampRegister  $stampRegister
     * @return void
     */
    public function restored(StampRegister $stampRegister)
    {
        $balance = StampBalance::query()->latest()->first();
        $lastBalance = $balance->balance;
        $lastBalance[$stampRegister->id] = 0;
        $balance->balance = $lastBalance;
        $balance->save();
    }

    /**
     * Handle the StampRegister "force deleted" event.
     *
     * @param  \App\Models\OutgoingModel\Stamps\StampRegister  $stampRegister
     * @return void
     */
    public function forceDeleted(StampRegister $stampRegister)
    {
        $balance = StampBalance::query()->latest()->first();
        $lastBalance = $balance->balance;
        unset($lastBalance[$stampRegister->id]);
        $balance->balance = $lastBalance;
        $balance->save();
    }
}
