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

            {{-- ── PONTO 2: Toast de questões pendentes ── --}}
            @if(session('warning'))
                <div x-data="{ show: true }" x-show="show" x-transition
                     x-init="setTimeout(() => show = false, 5000)"
                     class="mb-5 flex items-center gap-3 bg-amber-50 border border-amber-300 text-amber-800 px-5 py-3.5 rounded-xl text-sm font-medium shadow-sm">
                    <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ session('warning') }}</span>
                    <button @click="show = false" class="ml-auto text-amber-500 hover:text-amber-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

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

                {{-- ── QUESTÃO PRINCIPAL ── --}}
                <div class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                        {{-- Header da questão --}}
                        <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-8 py-6">
                            <div class="flex items-center gap-3 text-slate-400 text-xs mb-3">
                                <span class="bg-white/10 px-2 py-0.5 rounded text-xs font-semibold text-slate-300">
                                    Questão {{ $index + 1 }} de {{ $total }}
                                </span>
                                @if($question->course)
                                    <span>•</span><span>{{ $question->course->name }}</span>
                                @endif
                                <span>•</span><span>{{ $question->component }}</span>
                                <span>•</span><span>ENADE {{ $question->year }}</span>
                            </div>
                            <p class="text-white text-base leading-relaxed font-medium whitespace-pre-line">{{ $question->statement }}</p>
                        </div>

                        {{-- ── PONTO 1: Legenda de eliminação ── --}}
                        <div class="px-8 pt-5 pb-0 flex items-center gap-2 text-xs text-slate-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Clique no <span class="font-semibold text-slate-500 mx-1">×</span> para eliminar uma alternativa visualmente.
                        </div>

                        {{-- Alternativas --}}
                        <form action="{{ route('simulado.responder', $index) }}" method="POST" id="answer-form">
                            @csrf
                            <div class="p-8 pt-4 space-y-3">
                                @php $letters = ['A', 'B', 'C', 'D', 'E']; @endphp

                                @foreach($question->alternatives as $i => $alt)
                                    @php $isSelected = isset($answers[$question->id]) && $answers[$question->id] == $alt->id; @endphp

                                    {{-- ── PONTO 1: Alpine.js por alternativa ── --}}
                                    <div x-data="{ eliminated: false }">
                                        <div :class="eliminated ? 'opacity-35 pointer-events-none' : ''"
                                             class="relative flex items-start gap-4 p-4 rounded-xl border-2 transition-all duration-200
                                                    {{ $isSelected ? 'border-indigo-600 bg-indigo-50' : 'border-slate-200 hover:border-indigo-400 hover:bg-slate-50' }}">

                                            {{-- Radio (visually hidden, ativa ao clicar na label) --}}
                                            <input type="radio" name="alternative_id" value="{{ $alt->id }}"
                                                   id="alt-{{ $alt->id }}" class="sr-only"
                                                   @checked($isSelected)
                                                   onchange="this.form.submit()">

                                            {{-- Letter badge --}}
                                            <label for="alt-{{ $alt->id }}" class="cursor-pointer flex items-start gap-4 flex-1 min-w-0">
                                                <div class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold
                                                            {{ $isSelected ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600' }}">
                                                    {{ $letters[$i] ?? $i + 1 }}
                                                </div>
                                                <span :class="eliminated ? 'line-through text-slate-400' : 'text-slate-700'"
                                                      class="text-sm leading-relaxed pt-0.5">{{ $alt->text }}</span>
                                            </label>

                                            @if($isSelected)
                                                <div class="shrink-0 self-center">
                                                    <div class="w-5 h-5 bg-indigo-600 rounded-full flex items-center justify-center">
                                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- ── Botão de eliminação (fora do pointer-events-none) ── --}}
                                        <button type="button"
                                                @click="eliminated = !eliminated"
                                                :title="eliminated ? 'Restaurar alternativa' : 'Eliminar alternativa'"
                                                :class="eliminated
                                                    ? 'bg-red-100 text-red-500 border-red-300 hover:bg-red-200'
                                                    : 'bg-slate-50 text-slate-300 border-slate-200 hover:text-red-400 hover:bg-red-50 hover:border-red-200'"
                                                class="absolute top-3.5 right-3.5 w-6 h-6 rounded-md border flex items-center justify-center transition-all duration-150 -mt-px z-10"
                                                style="position: absolute; top: calc({{ $i * (4 + 0.75) }}rem + 1rem + 3.5rem); right: 3rem;"
                                                @click.stop>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Navegação --}}
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
                                    <button type="button"
                                            onclick="document.getElementById('answer-form').requestSubmit ? document.getElementById('answer-form').dispatchEvent(new Event('submit', {bubbles:true})) : document.getElementById('answer-form').submit()"
                                            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-6 py-2.5 rounded-xl transition">
                                        Finalizar
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── SIDEBAR ── --}}
                <div class="lg:w-72 shrink-0 space-y-4">

                    {{-- Cronômetro --}}
                    <div x-data="{
                            remaining: {{ $remaining }},
                            get urgent() { return this.remaining < 300; },
                            init() {
                                const tick = setInterval(() => {
                                    if (this.remaining > 0) { this.remaining--; }
                                    else { clearInterval(tick); window.location.href = '{{ route('simulado.resultado') }}'; }
                                }, 1000);
                            },
                            format(s) {
                                const h = String(Math.floor(s / 3600)).padStart(2,'0');
                                const m = String(Math.floor((s % 3600) / 60)).padStart(2,'0');
                                const sec = String(s % 60).padStart(2,'0');
                                return h+':'+m+':'+sec;
                            }
                         }"
                         class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Tempo restante</p>
                        <div :class="urgent ? 'text-red-600' : 'text-slate-900'"
                             class="text-4xl font-extrabold font-mono transition-colors mb-2"
                             x-text="format(remaining)">{{ gmdate('H:i:s', $remaining) }}</div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3">
                            <div :class="urgent ? 'bg-red-500' : 'bg-indigo-600'"
                                 class="h-1.5 rounded-full transition-all"
                                 :style="`width: ${Math.min(100, (remaining / {{ max(1, $remaining) }}) * 100)}%`"></div>
                        </div>
                        <p x-show="urgent" class="text-xs text-red-500 mt-2 font-medium animate-pulse">Menos de 5 minutos!</p>
                    </div>

                    {{-- Grade de navegação --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Navegação</p>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($questionIds as $i => $qId)
                                @php
                                    $isAnswered = isset($answers[$qId]);
                                    $isCurrent  = $i === $index;
                                @endphp
                                <a href="{{ route('simulado.show', $i) }}"
                                   class="aspect-square flex items-center justify-center rounded-lg text-xs font-bold transition-all
                                          {{ $isCurrent  ? 'bg-indigo-600 text-white ring-2 ring-indigo-600 ring-offset-2' :
                                             ($isAnswered ? 'bg-green-100 text-green-700 border border-green-300' :
                                                            'bg-slate-100 text-slate-500 hover:bg-indigo-100 hover:text-indigo-700') }}">
                                    {{ $i + 1 }}
                                </a>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-4 mt-4 text-xs text-slate-500">
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded bg-green-100 border border-green-300"></div>Respondida
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded bg-indigo-600"></div>Atual
                            </div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-3 h-3 rounded bg-slate-100"></div>Pendente
                            </div>
                        </div>
                    </div>

                    {{-- Botão finalizar --}}
                    <a href="{{ route('simulado.resultado') }}"
                       class="flex items-center justify-center gap-2 w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Finalizar ({{ count($answers) }}/{{ $total }})
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ── PONTO 1: CSS de eliminação ── --}}
    <style>
        /* Garante que o botão × flutue corretamente sobre cada alternativa */
        [x-data] { position: relative; }
    </style>
</x-app-layout>
