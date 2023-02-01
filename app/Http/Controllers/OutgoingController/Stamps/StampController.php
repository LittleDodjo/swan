<?php

namespace App\Http\Controllers\OutgoingController\Stamps;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingRequest\Stamps\StoreStampBalanceRequest;
use App\Http\Requests\OutgoingRequest\Stamps\StoreStampRegisterRequest;
use App\Http\Requests\OutgoingRequest\Stamps\UpdateStampRegisterRequest;
use App\Http\Resources\OutgoingResource\Stamps\StampHistoryResourceCollection;
use App\Http\Resources\OutgoingResource\Stamps\StampRegisterResource;
use App\Http\Resources\OutgoingResource\Stamps\StampRegisterResourceCollection;
use App\Models\OutgoingModel\Stamps\StampHistory;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class StampController extends Controller
{


    /**
     * StampController constructor.
     */
    public function __construct()
    {

    }


    /**
     * Возвразает реестр марок и текущий балланс
     * @return Response|Application|ResponseFactory
     */
    public function register(): Response|Application|ResponseFactory
    {
        return response(new StampRegisterResourceCollection(StampRegister::all()));
    }


    public function show(StampRegister $stamp){
        return response(new StampRegisterResource($stamp));
    }

    /**
     * Добавляет номинал в реестр
     * @param StoreStampRegisterRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function storeRegister(StoreStampRegisterRequest $request): Response|Application|ResponseFactory
    {
        StampRegister::create($request->validated());
        return response(['message' => 'Номинал добавлен в реестр']);
    }

    /**
     * Изменить номинал
     * @param UpdateStampRegisterRequest $request
     * @param StampRegister $stamp
     * @return Response|Application|ResponseFactory
     */
    public function updateRegister(UpdateStampRegisterRequest $request, StampRegister $stamp): Response|Application|ResponseFactory
    {
        $stamp->update($request->validated());
        return response(['message' => 'Номинал обновлен']);
    }

    /**
     * Удалить номинал из реестра программно
     * @param StampRegister $stamp
     * @return Response|Application|ResponseFactory
     */
    public function deleteRegister(StampRegister $stamp): Response|Application|ResponseFactory
    {
        $stamp->delete();
        return response(['message' => 'Номинал удален из реестра']);
    }

    /**
     * Удалить номинал навсегда
     * @param StampRegister $stamp
     * @return Response|Application|ResponseFactory
     */
    public function forceDeleteRegister(StampRegister $stamp): Response|Application|ResponseFactory
    {
        $stamp->forceDelete();
        return response(['message' => 'Номинал удален из реестра навсегда']);
    }

    /**
     * Восстановить номинал
     * @param $stamp
     * @return Response|Application|ResponseFactory
     */
    public function restoreRegister($stamp): Response|Application|ResponseFactory
    {
        StampRegister::onlyTrashed()->where('id', $stamp)->restore();
        return response(['message' => 'Номинал восстановлен в реестр']);
    }


    /**
     * Добавить поступление на балланс
     * @param StoreStampBalanceRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function balance(StoreStampBalanceRequest $request): Response|Application|ResponseFactory
    {
        foreach ($request->balance as $key => $value) {
            $stamp = StampRegister::find($value['id']);
            $stamp->update(['count' => $value['count'] + $stamp->count]);
        }
        StampHistory::create([
            'type' => true,
            'stamps' => $request->balance,
        ]);
        return response(['message' => 'Балланс успешно обновлен']);
    }

    /**
     * Получить историю с пагинацией в 50 элементов
     * @return Response|Application|ResponseFactory
     */
    public function history(): Response|Application|ResponseFactory
    {
        $history = StampHistory::orderBy('id', 'desc')->paginate(50);
        return response(new StampHistoryResourceCollection($history));
    }
}
