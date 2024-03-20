<?php

namespace App\Http\Controllers;

use App\Models\Enquetes;
use App\Models\Opcoes;
use App\Models\Perguntas;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

use function PHPUnit\Framework\isEmpty;

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

        foreach ($validated['perguntas'] as $chavePergunta => $pergunta) {
            $perguntaCriada = $enquete->perguntas()->create([
                'titulo' => $pergunta['titulo'],
                'enquete_id' => $enquete->id,
            ]);


            foreach ($validated['opcoes'] as $chaveOpcao => $opcoes) {
                if ($chaveOpcao == $chavePergunta) {
                    foreach ($opcoes as $opcao) {
                        $perguntaCriada->opcoes()->create([
                            'titulo' => $opcao,
                            'pergunta_id' => $perguntaCriada->id,
                        ]);
                    }
                }
            }
        }

        return redirect(route('enquetes.index'));
    }

    public function show(int $id)
    {

        $enquete = Enquetes::with('user', 'perguntas')->where('id', '=', $id)->first();
        $perguntas = Perguntas::with('opcoes')->where('enquete_id', '=', $id)->get();

        return view('enquetes.show', [
            'enquete' => $enquete,
            'perguntas' => $perguntas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {

        $enquete = Enquetes::with('user', 'perguntas')->where('id', '=', $id)->first();
        $perguntas = Perguntas::with('opcoes')->where('enquete_id', '=', $id)->get();

        if ($enquete) {
            if (auth()->check() && $enquete->user->id === auth()->user()->id) {
                return view('enquetes.edit', [
                    'enquete' => $enquete,
                    'perguntas' => $perguntas,
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_termino' => 'required|date',
            'perguntas' => 'required',
            'opcoes' => 'required',
        ]);

        $enquete = Enquetes::with('user', 'perguntas')->where('id', '=', $id)->first();
        $perguntasAntigas = Perguntas::with('opcoes')->where('enquete_id', '=', $id)->get();
        $quantidadePerguntasAntigas = $perguntasAntigas->count();

        $enquete->update($validated);

        try {
            $i = 0;
            foreach ($validated['perguntas'] as $chavePergunta => $pergunta) {

                if ($i < $quantidadePerguntasAntigas) {
                    $perguntasAntigas[$i]->update([
                        'titulo' => $pergunta['titulo'],
                    ]);
                }

                if ($i >= $quantidadePerguntasAntigas) {
                    $perguntasCriadas[$i] = $enquete->perguntas()->create([
                        'titulo' => $pergunta['titulo'],
                        'enquete_id' => $enquete->id,
                    ]);
                }

                try{
                    $j = 0;
                    foreach ($validated['opcoes'][$chavePergunta] as $chaveOpcao => $opcaoSubmetida) {

                        if (isset($perguntasCriadas[$i])) {

                            $perguntasCriadas[$i]->opcoes()->create([
                                'titulo' => $opcaoSubmetida,
                                'pergunta_id' => $perguntasCriadas[$i]->id,
                            ]);

                        } else {

                            $opcoesAntigas = Opcoes::where('pergunta_id', '=', $perguntasAntigas[$i]->id)->get();
                            $quantidadeOpcoesAntigas = $opcoesAntigas->count();

                            if ($j < $quantidadeOpcoesAntigas) {
                                $opcoesAntigas[$j]->update([
                                    'titulo' => $opcaoSubmetida,
                                ]);
                            }

                            if ($j >= $quantidadeOpcoesAntigas) {
                                $perguntasAntigas[$i]->opcoes()->create([
                                    'titulo' => $opcaoSubmetida,
                                    'pergunta_id' => $perguntasAntigas[$i]->id,
                                ]);
                            }

                        }

                        $j++;

                    }

                    while(($quantidadeOpcoesAntigas - $j) > 0){
                        $opcoesAntigas[$j]->delete();
                        $j++;
                    }

                } catch (Exception $x) {

                }

                $i++;

            }

            while(($quantidadePerguntasAntigas - $i) > 0){
                $perguntasAntigas[$i]->delete();
                $i++;
            }

        } catch (Exception $e) {

        }

        return redirect(route('enquetes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquetes  $enquetes
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): RedirectResponse
    {
        $enquete = Enquetes::where('id', '=', $id)->first();

        if ($enquete) {
            if (auth()->check() && $enquete->user->id === auth()->user()->id) {

                $enquete->delete();
                return redirect(route('enquetes.index'));
            }
        }
    }
}
