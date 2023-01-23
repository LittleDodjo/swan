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
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

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
        return response(new OutgoingRegisterResourceCollection(OutgoingRegister::paginate(15)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOutgoingRegisterRequest $request
     * @return Response
     */
    public function store(StoreOutgoingRegisterRequest $request): Response
    {
        $balance = StampBalance::orderby('id', 'desc')->first()->balance;
        foreach ($request->stamps_used as $key => $value) {
            if ($balance[$value['id']] < $value['count']) {
                return response(['message' => 'На баллансе недостаточно марок'], 400);
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
        $newStamps = $outgoing->stamps_used;
        if (Arr::exists($request->validated(), 'stamps_used')) {
            $balance = StampBalance::orderby('id', 'desc')->first()->balance;
            foreach ($request->stamps_used as $key => $value) {
                if ($balance[$value['id']] < ($value['count'] - $outgoing->stamps_used[$value['id']]['count'])) {
                    return response(['message' => 'На баллансе недостаточно марок для изменения'], 400);
                }
                $newStamps[$value['id']]['count'] = $value['count'];
            }
        }
        $outgoing->update([$request->safe()->except('stamps_used'), 'stamps_used' => $newStamps]);
        return \response(['message' => 'Документ успешно изменен']);
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
}
