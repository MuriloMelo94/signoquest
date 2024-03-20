<x-app-layout>
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
                            <small class="w-fit text-sm text-center text-gray-600">
                                {{ __('Em andamento') }}
                            </small>

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
            @foreach ($perguntas as $pergunta)
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <div class="p-6 flex flex-col space-x-2">
                        <div class="flex justify-between">
                            <p class="my-3 font-semibold"> {{ $i }}. {{ $pergunta->titulo }}</p>
                            <span class="me-3 self-center font-medium text-sm text-gray-700 h-auto">(*)Obrigatório</span>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            @foreach ($pergunta->opcoes as $opcao)
                                <div class="flex justify-start items-center">
                                    <x-radio-input required name="{{ $pergunta->id }}" value="{{ $opcao->id }}" />
                                    <x-input-label class="ms-2 place-content-center"
                                        for="{{ $opcao->id }}">{{ $opcao->titulo }}</x-input-label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Votar') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
