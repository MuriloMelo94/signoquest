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
                    <x-secondary-button class="w-fit mt-3 self-center" id="btnAdicionarOpcao">{{ __('Nova opção') }}
                    </x-secondary-button>
                </div>
            </div>
        `);
    }
