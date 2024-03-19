<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('enquetes.update', $enquete, $enquete->id) }}">
            @csrf
            @method('patch')

            <h3 class="font-medium text-gray-700 mb-2">Título da enquete:</h3>
            <x-text-input name="titulo" autocomplete="off" required
                placeholder="{{ __('Qual o novo título da enquete?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ $enquete->titulo }}"></x-text-input>
            <div class="flex">
                <div class="flex-initial w-64">
                    <x-input-label class="mt-2" for="data_inicio">Início da enquete</x-input-label>
                    <x-text-input name="data_inicio" required type="date"
                        value="{{ $enquete->data_inicio }}"></x-text-input>
                </div>
                <div class="flex-initial w-64">
                    <x-input-label class="mt-2" for="data_termino">Término da enquete</x-input-label>
                    <x-text-input name="data_termino" required type="date"
                        value="{{ $enquete->data_inicio }}"></x-text-input>
                </div>
            </div>

            <hr class="my-3">

            <h3 class="font-medium text-gray-700 mb-2">Perguntas da enquete:</h3>
            <div class="flex flex-col gap-3" id="secaoPerguntas">

                @php
                    $i = 0;
                @endphp
                @foreach ($perguntas as $pergunta)
                    <div class="p-4 bg-white shadow-sm rounded-lg perguntaAdicionada">
                        <div class="flex flex-col">
                            <div class="perguntas" data-contagem="{{ $i }}">
                                <x-input-label class="mt-2" for="pergunta[{{ $i }}]">Título da
                                    pergunta:</x-input-label>
                                <x-text-input required name="perguntas[{{ $i }}][titulo]" autocomplete="off"
                                    placeholder="{{ __('Escreva uma pergunta') }}"
                                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    value="{{ $pergunta->titulo }}"></x-text-input>
                            </div>
                            <x-input-label class="mt-2" for="opcoes">Opções de resposta:</x-input-label>
                            <div id="opcoes" class="flex flex-col space-y-2">
                                @php
                                    $j = 0;
                                @endphp
                                @foreach ($pergunta->opcoes as $opcoes)
                                    @if ($j < 3)
                                        <div class="flex items-center">
                                            <x-text-input required autocomplete="off"
                                                name="opcoes[{{ $i }}][]"
                                                placeholder="{{ __('Escreva uma opção de resposta') }}"
                                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                                value="{{ $opcoes->titulo }}"></x-text-input>
                                            <span
                                                class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                                        </div>
                                    @else
                                        <div class="flex items-center opcaoAdicionada">
                                            <x-text-input autocomplete="off" name="opcoes[{{ $i }}][]"
                                                placeholder="{{ __('Escreva uma opção de resposta') }}"
                                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                                value="{{ $opcoes->titulo }}"></x-text-input>
                                            <x-secondary-button id="btnRemoverOpcao" class="w-fit ms-2"
                                                onclick="removerOpcao(this)">{{ __('Remover') }}
                                            </x-secondary-button>
                                        </div>
                                    @endif
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                            </div>
                            <x-secondary-button class="w-fit mt-3 self-center btnAdicionarOpcao">{{ __('Nova opcao') }}
                            </x-secondary-button>

                            @if ($i > 0)
                                <x-secondary-button id="btnRemoverPergunta" class="w-fit mt-3 self-center"
                                    onclick="removerPergunta(this)">{{ __('Remover Pergunta') }}
                                </x-secondary-button>
                            @endif

                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach

            </div>
            <div class="mt-4">
                <x-secondary-button id="btnAdicionarPergunta" onclick="adicionarPergunta()">{{ __('Nova pergunta') }}
                </x-secondary-button>
            </div>

            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Salvar') }}</x-primary-button>
            <a class="ml-2" href="{{ route('enquetes.index') }}">{{ __('Cancelar') }}</a>
        </form>
    </div>
</x-app-layout>

<script>
    function removerOpcao(button) {
        $(button).closest('.opcaoAdicionada').remove();
    };

    function removerPergunta(button) {
        $(button).closest('.perguntaAdicionada').remove();
    };

    $(document).on('click', '.btnAdicionarOpcao', function() {
        var j = $(this).parent().children(".perguntas").data("contagem")

        $(this).parent().children("#opcoes").append(`
        <div class="flex items-center opcaoAdicionada">
            <x-text-input name="opcoes[` + j + `][]" autocomplete="off" required placeholder="{{ __('Escreva uma opção de resposta') }}"
            class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
            <x-secondary-button id="btnRemoverOpcao" class="w-fit ms-2" onclick="removerOpcao(this)">{{ __('Remover') }}</x-secondary-button>
            </div>
            `);
    });


    function adicionarPergunta() {
        let i = $('.perguntas').last().data("contagem")

        i++

        $("#secaoPerguntas").append(`
            <div class="p-4 bg-white shadow-sm rounded-lg perguntaAdicionada">
                <div class="flex flex-col">
                    <div class="perguntas" data-contagem="[` + i + `]">
                        <x-input-label class="mt-2" for="perguntas[` + i + `]">Título da pergunta:</x-input-label>
                        <x-text-input name="perguntas[` + i + `][titulo]" required autocomplete="off" placeholder="{{ __('Escreva sua pergunta') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                    </div>
                    <div id="opcoes" class="flex flex-col space-y-2">
                        <x-input-label class="mt-2" for="pergunta">Opções de resposta:</x-input-label>
                        <div class="flex items-center">
                            <x-text-input name="opcoes[` + i + `][]" required autocomplete="off" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                            <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>

                        <div class="flex items-center">
                            <x-text-input name="opcoes[` + i + `][]" required autocomplete="off" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                            <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>

                        <div class="flex items-center">
                            <x-text-input name="opcoes[` + i + `][]" required autocomplete="off" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                            <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>

                    </div>
                    <x-secondary-button class="w-fit mt-3 self-center btnAdicionarOpcao">{{ __('Nova opção') }}
                    </x-secondary-button>
                    <x-secondary-button id="btnRemoverPergunta" class="w-fit mt-3 self-center" onclick="removerPergunta(this)">{{ __('Remover Pergunta') }}
                    </x-secondary-button>
                </div>
            </div>
        `);
    }
</script>
