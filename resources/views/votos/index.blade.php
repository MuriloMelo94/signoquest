<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resultados') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <span class="text-gray-800">Criada por: {{ $enquete->user->name }}</span>
                            <small
                                class="text-sm text-gray-600">{{ $enquete->created_at->format('j M Y, g:i a') }}</small>
                        </div>
                        <div class="flex items-center">

                            @php
                                $dataInicio = \Carbon\Carbon::createFromFormat('Y-m-d', $enquete->data_inicio);
                                $dataTermino = \Carbon\Carbon::createFromFormat('Y-m-d', $enquete->data_termino);
                                $hoje = \Carbon\Carbon::now();
                            @endphp

                            @if ($dataInicio->lte($hoje) && $dataTermino->gte($hoje))
                                <small class="w-fit text-sm text-green-600 rounded-full">
                                    {{ __('Em andamento') }}
                                </small>
                            @elseif ($dataTermino->lte($hoje))
                                <small class="w-fit text-sm text-amber-700 rounded-full">
                                    {{ __('Finalizada') }}
                                </small>
                            @endif
                        </div>
                    </div>
                    <h3 class="mt-6 mb-4 text-2xl font-bold text-center text-gray-900">{{ $enquete->titulo }}</h3>
                </div>
            </div>
        </div>

        <form method="POST" action="">
            @csrf
            @php
                $i = 1;
            @endphp
            <x-text-input name="enquete_id" required hidden readonly value="{{ $enquete->id }}" />
            @foreach ($perguntas as $pergunta)
                <fieldset>
                    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                        <div class="p-6 flex flex-col space-x-2">
                            <div class="flex justify-between">
                                <legend class="my-3 font-semibold"> {{ $i }}. {{ $pergunta->titulo }}
                                </legend>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                @foreach ($pergunta->opcoes as $opcao)
                                    <div class="flex flex-col justify-start items-start">
                                        <x-input-label class="place-content-center" for="{{ $opcao->id }}">Opção:
                                            {{ $opcao->titulo }}
                                        </x-input-label>


                                        @php
                                            $j = 0;
                                        @endphp
                                        @foreach ($enquete->votos as $chave => $voto)

                                            @if ($voto->respostas['perguntas_id'] == $pergunta->id && $voto->respostas['opcoes_escolhidas_id'] == $opcao->id)
                                                @php
                                                    $j++
                                                @endphp
                                            @endif
                                        @endforeach
                                        <small class="ms-2 place-content-center text-sm text-gray-600">Total de votos:
                                            {{ $j }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </fieldset>
                @php
                    $i++;
                @endphp
            @endforeach
        </form>
        <x-secondary-button class="mt-2">
            <a href="{{ route('enquetes.index') }}">{{ __('Retornar') }}</a>
        </x-secondary-button>
    </div>
</x-app-layout>
