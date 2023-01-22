<?php

namespace App\Http\Controllers\OutgoingController\Stamps;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingRequest\Stamps\StoreStampBalanceRequest;
use App\Http\Resources\OutgoingResource\Stamps\StampBalanceHistoryResourceCollection;
use App\Http\Resources\OutgoingResource\Stamps\StampBalanceResource;
use App\Models\OutgoingModel\Stamps\StampBalance;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class StampBalanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Возвращает текущий баланс марок
     * @return Application|ResponseFactory|Response
     */
    public function index(): Response|Application|ResponseFactory
    {
        $stamp = StampBalance::query()->latest()->first();
        return response(new StampBalanceResource($stamp));
    }

    /**
     * Создает новое поступление марок на баланс
     * @return Application|Response|ResponseFactory
     */
    public function store(StoreStampBalanceRequest $request): Response|Application|ResponseFactory
    {
        $oldBalance = StampBalance::query()->latest()->first()->balance;
        $balance = new StampBalance();
        $balance->employee_id = Auth::user()->id;
        foreach ($request->balance as $key => $value) {
            $oldBalance[$value['id']] += $value['count'];
        }
        $balance->balance = $oldBalance;
        $balance->save();
        return response($balance);
    }

    public function history(): Response|Application|ResponseFactory
    {
        return response(new StampBalanceHistoryResourceCollection(StampBalance::paginate(15)));
    }
}
