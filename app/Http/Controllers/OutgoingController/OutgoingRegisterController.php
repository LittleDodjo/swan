<?php

namespace App\Http\Controllers\OutgoingController;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingRequest\StoreOutgoingRegisterRequest;
use App\Http\Requests\OutgoingRequest\UpdateOutgoingRegisterRequest;
use App\Http\Resources\OutgoingResource\OutgoingRegisterResource;
use App\Http\Resources\OutgoingResource\OutgoingRegisterResourceCollection;
use App\Models\OutgoingModel\OutgoingRegister;
use App\Models\OutgoingModel\Stamps\StampBalance;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OutgoingRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(OutgoingRegister::class, 'outgoing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(
            new OutgoingRegisterResourceCollection(OutgoingRegister::orderby('id', 'desc')->paginate(50))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOutgoingRegisterRequest $request
     * @return Response
     */
    public function store(StoreOutgoingRegisterRequest $request): Response
    {
        if(Arr::exists($request->validated(), 'stamps_used')){
            foreach ($request->stamps_used as $key => $value) {
                $stamp = StampRegister::find($value['id']);
                if($stamp->count - $value['count'] < 0) return response(['message' => 'Недостаточно марок на баллансе']);
            }
        }
        $outgoing = new OutgoingRegister($request->validated());
        $outgoing->employee_id = $request->user()->employee->id;
        $outgoing->save();
        return response(['message' => 'Исходящий документ создан']);
    }

    /**
     * Display the specified resource.
     *
     * @param OutgoingRegister $outgoing
     * @return Response
     */
    public function show(OutgoingRegister $outgoing): Response
    {
        return response(new OutgoingRegisterResource($outgoing));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOutgoingRegisterRequest $request
     * @param OutgoingRegister $outgoing
     * @return Response
     */
    public function update(UpdateOutgoingRegisterRequest $request, OutgoingRegister $outgoing): Response
    {
        $now = $outgoing->stamps();
        $needle = $request->stamps_used;
        return response([
            'Сейчас' => $now,
            'Нужно' => $needle,
        ]);

        if (Arr::exists($request->validated(), 'stamps_used')) {
            $balance = StampBalance::orderby('id', 'desc')->first()->balance; //последняя запись балланса
            $currentStamps = $outgoing->stamps_used; //текущие использованные марки в документе
            $needleStamps = $request->stamps_used; //те марки которые необходимо удалить
            foreach ($needleStamps as $key => $value) {
                if (Arr::exists($currentStamps, $value['id'])) {
                    if ((int)$balance[$value['id']] < (int)($value['count'] - $currentStamps[$value['id']]['count'])) {
                        return response(['message' => 'Недостаточно марок на баллансе'], 400);
                    }
                } else {
                    if ($balance[$value['id']] < $value['count']) {
                        return response(['message' => 'Недостаточно марок на баллансе'], 400);
                    }
                }
            }
            $outgoing->update(['stamps_used' => $needleStamps]);
        }
        $outgoing->update($request->safe()->except('stamps_used'));
        return response(['message' => 'Документ успешно изменен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OutgoingRegister $outgoing
     * @return Response
     */
    public function destroy(OutgoingRegister $outgoing): Response
    {
        $outgoing->delete();
        return response(['message' => 'Документ удален, использованые марки возвращены на балланс']);
    }

    /**
     * @param OutgoingRegister $outgoing
     * @return Response|Application|ResponseFactory
     */
    public function forceDelete(OutgoingRegister $outgoing): Response|Application|ResponseFactory
    {
        $outgoing->forceDelete();
        return \response(['message' => 'Документ удален навсегда, марки возвращены на балланс']);
    }

    public function restore(){

    }

}
