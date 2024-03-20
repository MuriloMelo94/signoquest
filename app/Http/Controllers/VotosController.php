<?php

namespace App\Http\Controllers;

use App\Models\Enquetes;
use App\Models\Perguntas;
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

        return view('votos.confirm-voto');

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

        $validated = $request->validate([
            'respostas' => 'required',
            'enquete_id' => 'required|numeric'
        ]);

        foreach($validated['respostas'] as $chaveResposta => $valorResposta){
            $respostas['perguntas_id'] = (int) $chaveResposta;
            $respostas['opcoes_escolhidas_id'] = (int) $valorResposta;
        }

        $voto = new votos();

        $voto->user_id = auth()->user()->id;
        $voto->enquete_id = $validated['enquete_id'];
        $voto->respostas = $respostas;

        $voto->save();

        return redirect(route('votos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\votos  $votos
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('votos.index', [
            'enquete' => Enquetes::with('user', 'perguntas', 'votos')->where('id', '=', $id)->first(),
            'perguntas' => Perguntas::with('opcoes')->where('id', '=', $id)->get(),
        ]);
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
