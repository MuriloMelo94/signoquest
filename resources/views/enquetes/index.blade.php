<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('enquetes.store') }}">
            @csrf
            <h3 class="font-medium text-gray-700 mb-2">Título da enquete:</h3>
            <x-text-input name="title" placeholder="{{ __('Qual o título da nova enquete?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('title') }}</x-text-input>
            <div class="flex">
                <div class="flex-initial w-64">
                    <x-input-label class="mt-2" for="data_inicio">Início da enquete</x-input-label>
                    <x-text-input name="data_inicio" type="date"></x-text-input>
                </div>
                <div class="flex-initial w-64">
                    <x-input-label class="mt-2" for="data_termino">Término da enquete</x-input-label>
                    <x-text-input name="data_termino" type="date"></x-text-input>
                </div>
            </div>

            <hr class="my-3">

            <h3 class="font-medium text-gray-700 mb-2">Perguntas da enquete:</h3>
            <div class="flex flex-col gap-3" id="secaoPerguntas">

                <div class="p-4 bg-white shadow-sm rounded-lg">
                    <div class="flex flex-col">
                        <div id="pergunta">
                            <x-input-label class="mt-2" for="pergunta">Título da pergunta:</x-input-label>
                            <x-text-input required name="perguntas[]" placeholder="{{ __('Escreva sua pergunta') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                        </div>
                        <div id="opcoes" class="flex flex-col space-y-2">
                            <x-input-label class="mt-2" for="pergunta">Opções de resposta:</x-input-label>
                            <div class="flex items-center">
                                <x-text-input required autocomplete="off" name="opcoes[]" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                    class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                                <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                            </div>

                            <div class="flex items-center">
                                <x-text-input required autocomplete="off" name="opcoes[]" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                    class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                                <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                            </div>

                            <div class="flex items-center">
                                <x-text-input required autocomplete="off" name="opcoes[]" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                    class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                                <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                            </div>

                        </div>
                        <x-secondary-button class="w-fit mt-3 self-center btnAdicionarOpcao"
                            >{{ __('Nova opcao') }}
                        </x-secondary-button>
                    </div>
                </div>

            </div>
            <div class="mt-4">
                <x-secondary-button id="btnAdicionarPergunta" onclick="adicionarPergunta()">{{ __('Nova pergunta') }}
                </x-secondary-button>
            </div>

            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Salvar') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>

<script>
    $(document).on('click', '.btnAdicionarOpcao', function(){
        $(this).parent().children("#opcoes").append(`
            <div class="flex items-center">
                <x-text-input name="opcoes[]" autocomplete="off" placeholder="{{ __('Escreva uma opção de resposta') }}"
                    class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
            </div>
        `);
    });

    function adicionarPergunta()
    {
        $("#secaoPerguntas").append(`
            <div class="p-4 bg-white shadow-sm rounded-lg">
                <div class="flex flex-col">
                    <div id="perguntas">
                        <x-input-label class="mt-2" for="pergunta">Título da pergunta:</x-input-label>
                        <x-text-input name="perguntas[]" placeholder="{{ __('Escreva sua pergunta') }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                    </div>
                    <div id="opcoes" class="flex flex-col space-y-2">
                        <x-input-label class="mt-2" for="pergunta">Opções de resposta:</x-input-label>
                        <div class="flex items-center">
                            <x-text-input name="opcoes[]" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                            <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>

                        <div class="flex items-center">
                            <x-text-input name="opcoes[]" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                            <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>

                        <div class="flex items-center">
                            <x-text-input name="opcoes[]" placeholder="{{ __('Escreva uma opção de resposta') }}"
                                class="block w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></x-text-input>
                            <span class=" ms-2 py-2 font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>

                    </div>
                    <x-secondary-button class="w-fit mt-3 self-center btnAdicionarOpcao">{{ __('Nova opção') }}
                    </x-secondary-button>
                </div>
            </div>
        `);
    }
</script>
