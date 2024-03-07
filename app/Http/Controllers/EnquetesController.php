<?php

namespace App\Http\Controllers;

use App\Models\Enquetes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class EnquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('enquetes.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function show(Enquetes $enquetes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquetes $enquetes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquetes $enquetes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquetes $enquetes)
    {
        //
    }
}
