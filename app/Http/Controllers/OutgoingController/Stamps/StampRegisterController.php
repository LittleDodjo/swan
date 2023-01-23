<?php

namespace App\Http\Controllers\OutgoingController\Stamps;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingRequest\Stamps\StoreStampRegisterRequest;
use App\Http\Requests\OutgoingRequest\Stamps\UpdateStampRegisterRequest;
use App\Http\Resources\OutgoingResource\Stamps\StampRegisterResourceCollection;
use App\Http\Resources\OutgoingResource\Stamps\StampRegisterResourceResource;
use App\Models\OutgoingModel\Stamps\StampRegister;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class StampRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(StampRegister::class, 'stamp');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return \response(new StampRegisterResourceCollection(StampRegister::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStampRegisterRequest $request
     * @return Response
     */
    public function store(StoreStampRegisterRequest $request): Response
    {
        StampRegister::create($request->validated());
        return response(['message' => 'Номинал марки успешно добавлен']);
    }

    /**
     * Display the specified resource.
     *
     * @param StampRegister $stamp
     * @return Response
     */
    public function show(StampRegister $stamp): Response
    {
        return \response(new StampRegisterResourceResource($stamp));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStampRegisterRequest $request
     * @param StampRegister $register
     * @return Application|ResponseFactory|Response
     */
    public function update(UpdateStampRegisterRequest $request, StampRegister $stamp): Response|Application|ResponseFactory
    {
        $stamp->update($request->validated());
        return response(['message' => 'Номинал успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StampRegister $stamp
     * @return Response
     */
    public function destroy(StampRegister $stamp): Response
    {
        $stamp->delete();
        return response(['message' => 'Номинал удален из реестра']);
    }
}
