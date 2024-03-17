<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($enquetes as $enquete)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $enquete->user->name }}</span>
                                <small
                                    class="ml-2 text-sm text-gray-600">{{ $enquete->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                        </div>
                        <p class="my-4 text-lg font-bold text-gray-900">{{ $enquete->titulo }}</p>
                        <div class="flex flex-col">
                            <span class="text-gray-800">Aceita respostas entre os dias: </span>
                            <small class="text-sm text-gray-600">{{ date('d/m/Y', strtotime($enquete->data_inicio)) }}
                                e {{ date('d/m/Y', strtotime($enquete->data_termino)) }}</small>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-col justify-between items-center p-4">

                            @php
                                $dataInicio = \Carbon\Carbon::createFromFormat('Y-m-d', $enquete->data_inicio);
                                $dataTermino = \Carbon\Carbon::createFromFormat('Y-m-d', $enquete->data_termino);
                                $hoje = \Carbon\Carbon::now();
                            @endphp

                            @if ($dataInicio->lte($hoje) && $dataTermino->gte($hoje))
                                <small class="w-fit text-sm text-gray-600 rounded-full">
                                    {{ __('Em andamento') }}
                                </small>
                                <x-secondary-button class="mt-3 self-center">
                                    <x-dropdown-link :href="route('enquetes.show', ['enquete' => $enquete])">
                                        {{ __('Votar') }}
                                    </x-dropdown-link>
                                </x-secondary-button>
                            @elseif ($dataTermino->lte($hoje))
                                <small class="w-fit text-sm text-amber-700 rounded-full">
                                    {{ __('Finalizada') }}
                                </small>
                            @elseif ($dataInicio->gte($hoje))
                                <small class="w-fit text-sm text-sky-700 rounded-full">
                                    {{ __('Não iniciada') }}
                                </small>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
