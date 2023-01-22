<?php

namespace App\Http\Controllers\OutgoingController;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingRequest\StoreOutgoingRegisterRequest;
use App\Models\OutgoingModel\Stamps\StampBalance;
use Illuminate\Http\Request;

class OutgoingRegisterController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingRegisterRequest $request)
    {
        $balance = StampBalance::query()->latest()->first();
        return response($request->stamps_used);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
