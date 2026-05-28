<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">Simulado em andamento</h2>
            <form action="{{ route('simulado.resultado') }}" method="GET">
                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium transition">
                    Encerrar simulado
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Progress Bar --}}
            <div class="mb-6">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span>Progresso do simulado</span>
                    <span>{{ count($answers) }}/{{ $total }} respondidas</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all duration-500"
                         style="width: {{ $total > 0 ? round((count($answers) / $total) * 100) : 0 }}%"></div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">

                {{-- Main Question Area --}}
                <div class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                        {{-- Question Header --}}
                        <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-8 py-6">
                            <div class="flex items-center gap-3 text-slate-400 text-xs mb-3">
                                <span class="bg-white/10 px-2 py-0.5 rounded text-xs font-semibold text-slate-300">
                                    Questão {{ $index + 1 }} de {{ $total }}
                                </span>
                                @if($question->course)
                                    <span>•</span>
                                    <span>{{ $question->course->name }}</span>
                                @endif
                                <span>•</span>
                                <span>{{ $question->component }}</span>
                                <span>•</span>
                                <span>ENADE {{ $question->year }}</span>
                            </div>
                            <p class="text-white text-base leading-relaxed font-medium">{{ $question->statement }}</p>
                        </div>

                        {{-- Alternatives Form --}}
                        <form action="{{ route('simulado.responder', $index) }}" method="POST" id="answer-form">
                            @csrf
                            <div class="p-8 space-y-3">
                                @php $letters = ['A', 'B', 'C', 'D', 'E']; @endphp
                                @foreach($question->alternatives as $i => $alt)
                                    @php $isSelected = isset($answers[$question->id]) && $answers[$question->id] == $alt->id; @endphp
                                    <label class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-150
                                                  {{ $isSelected ? 'border-indigo-600 bg-indigo-50' : 'border-slate-200 hover:border-indigo-400 hover:bg-slate-50' }}">
                                        <input type="radio" name="alternative_id" value="{{ $alt->id }}"
                                               class="sr-only" @checked($isSelected)
                                               onchange="this.form.submit()">
                                        <div class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold
                                                    {{ $isSelected ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600' }}">
                                            {{ $letters[$i] ?? $i + 1 }}
                                        </div>
                                        <span class="text-slate-700 text-sm leading-relaxed pt-0.5">{{ $alt->text }}</span>
                                        @if($isSelected)
                                            <div class="ml-auto shrink-0">
                                                <div class="w-5 h-5 bg-indigo-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                                                </div>
                                            </div>
                                        @endif
                                    </label>
                                @endforeach
                            </div>

                            {{-- Navigation Footer --}}
                            <div class="px-8 pb-8 flex items-center justify-between">
                                @if($index > 0)
                                    <a href="{{ route('simulado.show', $index - 1) }}"
                                       class="flex items-center gap-2 text-slate-600 hover:text-indigo-600 font-medium text-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                        Anterior
                                    </a>
                                @else
                                    <div></div>
                                @endif

                                @if($index < $total - 1)
                                    <a href="{{ route('simulado.show', $index + 1) }}"
                                       class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm px-6 py-2.5 rounded-xl transition">
                                        Próxima
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('simulado.resultado') }}"
                                       class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-6 py-2.5 rounded-xl transition">
                                        Finalizar
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:w-72 shrink-0 space-y-4">

                    {{-- Timer Card --}}
                    <div x-data="{
                        remaining: {{ $remaining }},
                        get urgent() { return this.remaining < 300; },
                        init() {
                            const tick = setInterval(() => {
                                if (this.remaining > 0) {
                                    this.remaining--;
                                } else {
                                    clearInterval(tick);
                                    window.location.href = '{{ route('simulado.resultado') }}';
                                }
                            }, 1000);
                        },
                        format(s) {
                            const h = String(Math.floor(s / 3600)).padStart(2, '0');
                            const m = String(Math.floor((s % 3600) / 60)).padStart(2, '0');
                            const sec = String(s % 60).padStart(2, '0');
                            return h + ':' + m + ':' + sec;
                        }
                    }" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Tempo restante</p>
                        <div :class="urgent ? 'text-red-600' : 'text-slate-900'"
                             class="text-4xl font-extrabold font-mono transition-colors mb-2"
                             x-text="format(remaining)">
                            {{ gmdate('H:i:s', $remaining) }}
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3">
                            <div :class="urgent ? 'bg-red-500' : 'bg-indigo-600'"
                                 class="h-1.5 rounded-full transition-all"
                                 :style="`width: ${Math.min(100, (remaining / {{ $remaining > 0 ? $remaining : 3600 }}) * 100)}%`">
                            </div>
                        </div>
                        <p x-show="urgent" class="text-xs text-red-500 mt-2 font-medium animate-pulse">Atenção! Menos de 5 minutos!</p>
                    </div>

                    {{-- Question Navigator --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Navegação</p>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($questionIds as $i => $qId)
                                @php
                                    $isAnswered = isset($answers[$qId]);
                                    $isCurrent = $i === $index;
                                @endphp
                                <a href="{{ route('simulado.show', $i) }}"
                                   class="aspect-square flex items-center justify-center rounded-lg text-xs font-bold transition-all
                                          {{ $isCurrent ? 'bg-indigo-600 text-white ring-2 ring-indigo-600 ring-offset-2' :
                                             ($isAnswered ? 'bg-green-100 text-green-700 border border-green-300' :
                                              'bg-slate-100 text-slate-500 hover:bg-indigo-100 hover:text-indigo-700') }}">
                                    {{ $i + 1 }}
                                </a>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-4 mt-4 text-xs text-slate-500">
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded bg-green-100 border border-green-300"></div>
                                Respondida
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded bg-indigo-600"></div>
                                Atual
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded bg-slate-100"></div>
                                Pendente
                            </div>
                        </div>
                    </div>

                    {{-- Submit All --}}
                    <a href="{{ route('simulado.resultado') }}"
                       class="flex items-center justify-center gap-2 w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Finalizar Simulado ({{ count($answers) }}/{{ $total }})
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
