<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">Resultado do Simulado</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Score Card --}}
            <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-2xl p-8 text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg viewBox="0 0 200 200" class="w-full h-full"><circle cx="160" cy="40" r="80" fill="white"/><circle cx="40" cy="160" r="60" fill="white"/></svg>
                </div>
                <div class="relative">
                    @php
                        $emoji = $percentual >= 70 ? '🎉' : ($percentual >= 50 ? '👍' : '💪');
                        $msg   = $percentual >= 70 ? 'Excelente desempenho!' : ($percentual >= 50 ? 'Bom trabalho!' : 'Continue praticando!');
                    @endphp
                    <div class="text-5xl mb-3">{{ $emoji }}</div>
                    <div class="text-7xl font-extrabold text-white mb-2">{{ $percentual }}%</div>
                    <p class="text-indigo-200 text-lg font-semibold mb-1">{{ $msg }}</p>
                    <p class="text-indigo-300 text-sm">{{ $corretas }} de {{ $total }} questões corretas &bull; Tempo: {{ $tempoGasto }}</p>
                </div>
            </div>

            {{-- Stats Row --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                    <div class="text-3xl font-extrabold text-green-600 mb-1">{{ $corretas }}</div>
                    <div class="text-sm text-slate-500">Acertos</div>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                    <div class="text-3xl font-extrabold text-red-500 mb-1">{{ $total - $corretas }}</div>
                    <div class="text-sm text-slate-500">Erros</div>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm text-center">
                    <div class="text-3xl font-extrabold text-slate-700 mb-1">{{ $total }}</div>
                    <div class="text-sm text-slate-500">Total</div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('simulado.index') }}" class="flex-1 flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Novo Simulado
                </a>
                <a href="{{ route('pratica.index') }}" class="flex-1 flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-indigo-300 text-slate-700 font-semibold py-3 rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    Modo Prática
                </a>
                <a href="{{ route('dashboard') }}" class="flex-1 flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-indigo-300 text-slate-700 font-semibold py-3 rounded-xl transition">
                    Página Inicial
                </a>
            </div>

            {{-- Question Review --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800">Revisão das questões</h3>
                </div>

                <div class="divide-y divide-slate-100">
                    @foreach($results as $i => $result)
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center mt-0.5
                                            {{ $result['acertou'] ? 'bg-green-100' : 'bg-red-100' }}">
                                    @if($result['acertou'])
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-2 text-xs text-slate-400">
                                        <span class="font-semibold text-slate-600">Q{{ $i + 1 }}</span>
                                        @if($result['question']->course)
                                            <span>•</span><span>{{ $result['question']->course->name }}</span>
                                        @endif
                                        <span>•</span><span>ENADE {{ $result['question']->year }}</span>
                                    </div>
                                    <p class="text-slate-700 text-sm mb-3 leading-relaxed">{{ Str::limit($result['question']->statement, 200) }}</p>

                                    @if(!$result['acertou'] && $result['chosen'])
                                        <div class="text-xs text-red-600 bg-red-50 border border-red-200 px-3 py-2 rounded-lg mb-2">
                                            <strong>Sua resposta:</strong> {{ Str::limit($result['chosen']->text, 120) }}
                                        </div>
                                    @elseif(!$result['chosen'])
                                        <div class="text-xs text-amber-600 bg-amber-50 border border-amber-200 px-3 py-2 rounded-lg mb-2">
                                            Questão não respondida
                                        </div>
                                    @endif

                                    @if(!$result['acertou'] && $result['correct'])
                                        <div class="text-xs text-green-700 bg-green-50 border border-green-200 px-3 py-2 rounded-lg">
                                            <strong>Resposta correta:</strong> {{ Str::limit($result['correct']->text, 120) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
