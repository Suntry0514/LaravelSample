<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRestdataRequest;
use App\Http\Requests\UpdateRestdataRequest;
use App\Models\Restdata;

class RestdataController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestdataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestdataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restdata  $restdata
     * @return \Illuminate\Http\Response
     */
    public function show(Restdata $restdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restdata  $restdata
     * @return \Illuminate\Http\Response
     */
    public function edit(Restdata $restdata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestdataRequest  $request
     * @param  \App\Models\Restdata  $restdata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestdataRequest $request, Restdata $restdata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restdata  $restdata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restdata $restdata)
    {
        //
    }
}
