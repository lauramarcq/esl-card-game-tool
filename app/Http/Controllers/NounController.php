<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNounRequest;
use App\Http\Requests\UpdateNounRequest;
use App\Models\Noun;

class NounController extends Controller
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
    public function store(StoreNounRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Noun $noun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noun $noun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNounRequest $request, Noun $noun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noun $noun)
    {
        //
    }
}
