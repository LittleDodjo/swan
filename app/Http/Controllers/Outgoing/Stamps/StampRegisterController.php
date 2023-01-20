<?php

namespace App\Http\Controllers\Outgoing\Stamps;

use App\Http\Controllers\Controller;
use App\Http\Requests\Outgoing\Stamps\StoreStampRegisterRequest;
use App\Http\Requests\Outgoing\Stamps\UpdateStampRegisterRequest;
use App\Http\Resources\Outgoing\Stamps\StampRegisterResourceCollection;
use App\Http\Resources\Outgoing\Stamps\StampRegisterResourceResource;
use App\Models\Outgoing\Stamps\StampRegister;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class StampRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(StampRegister::class, 'register');
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
     * @param StampRegister $register
     * @return Response
     */
    public function show(StampRegister $register): Response
    {
        return \response(new StampRegisterResourceResource($register));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStampRegisterRequest $request
     * @param StampRegister $register
     * @return Application|ResponseFactory|Response
     */
    public function update(UpdateStampRegisterRequest $request, StampRegister $register): Response|Application|ResponseFactory
    {
        $register->update($request->validated());
        return response(['message' => 'Номинал успешно обновлен', $register]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StampRegister $register
     * @return Response
     */
    public function destroy(StampRegister $register): Response
    {
        $register->delete();
        return response(['message' => 'Номинал удален из реестра']);
    }
}
