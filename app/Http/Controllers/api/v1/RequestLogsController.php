<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\RequestLogs;
use App\Http\Requests\StoreRequestLogsRequest;
use App\Http\Requests\UpdateRequestLogsRequest;

class RequestLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestLogsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestLogs $requestLogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestLogs $requestLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestLogsRequest $request, RequestLogs $requestLogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestLogs $requestLogs)
    {
        //
    }
}
