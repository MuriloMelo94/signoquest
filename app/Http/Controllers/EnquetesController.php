<?php

namespace App\Http\Controllers;

use App\Models\Enquetes;
use App\Models\Perguntas;
use Illuminate\Http\RedirectResponse;
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
        return view('enquetes.index', [
            'enquetes' => Enquetes::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enquetes.create');
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
            'titulo' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date',
            'perguntas' => 'required',
            'opcoes' => 'required',
        ]);


        $enquete = $request->user()->enquetes()->create($validated);

        foreach($validated['perguntas'] as $chavePergunta => $pergunta){
            $perguntaCriada = $enquete->perguntas()->create([
                'titulo' => $pergunta['titulo'],
                'enquete_id' => $enquete->id,
            ]);


            foreach($validated['opcoes'] as $chaveOpcao => $opcoes){
                if($chaveOpcao == $chavePergunta){
                    foreach($opcoes as $opcao){
                        $perguntaCriada->opcoes()->create([
                            'titulo' => $opcao,
                            'pergunta_id' => $perguntaCriada->id,
                        ]);
                    }
                }
            }

        }

        // foreach($validated['opcoes.*'] as $opcao){
        //     // $pergunta->opcoes()->create([
        //     //     'titulo' => $opcao['titulo'],
        //     //     'pergunta_id' => $pergunta->id,
        //     // ]);
        // }

        return redirect(route('enquetes.index'));
    }

    public function show(int $id)
    {

        $enquete = Enquetes::with('user', 'perguntas')->where('id', '=', $id)->first();

        return view('enquetes.show', [
            'enquete' => $enquete,
            'perguntas' => Perguntas::with('opcoes')->where('enquete_id', '=', $id)->get(),
        ]);
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
