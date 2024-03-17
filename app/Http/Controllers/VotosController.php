<?php

namespace App\Http\Controllers;

use App\Models\votos;
use Illuminate\Http\Request;

class VotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('votos.index');
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
     * @param  \App\Models\votos  $votos
     * @return \Illuminate\Http\Response
     */
    public function show(votos $votos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\votos  $votos
     * @return \Illuminate\Http\Response
     */
    public function edit(votos $votos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\votos  $votos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, votos $votos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\votos  $votos
     * @return \Illuminate\Http\Response
     */
    public function destroy(votos $votos)
    {
        //
    }
}
