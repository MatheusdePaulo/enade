<x-admin-layout>
    <x-slot name="title">Painel Administrativo</x-slot>
    <x-slot name="subtitle">Visão geral e gerenciamento de questões</x-slot>

    {{-- ── METRIC CARDS ────────────────────────────────────── --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        {{-- Alunos --}}
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-indigo-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-lg">Alunos</span>
            </div>
            <div class="text-3xl font-extrabold text-white mb-0.5">{{ number_format($totalStudents) }}</div>
            <div class="text-xs text-slate-500">Estudantes cadastrados</div>
        </div>

        {{-- Questões --}}
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-violet-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-violet-400 bg-violet-500/10 px-2 py-1 rounded-lg">Banco</span>
            </div>
            <div class="text-3xl font-extrabold text-white mb-0.5">{{ number_format($totalQuestions) }}</div>
            <div class="text-xs text-slate-500">Questões no banco</div>
        </div>

        {{-- Cursos --}}
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-emerald-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded-lg">Cursos</span>
            </div>
            <div class="text-3xl font-extrabold text-white mb-0.5">{{ $totalCourses }}</div>
            <div class="text-xs text-slate-500">Cursos cadastrados</div>
        </div>

        {{-- Questão mais respondida --}}
        <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/10 border border-amber-500/30 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-amber-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-amber-400 bg-amber-500/10 px-2 py-1 rounded-lg">Top</span>
            </div>
            @if($topQuestion)
                <div class="text-3xl font-extrabold text-white mb-0.5">{{ number_format($topQuestion->times_answered) }}×</div>
                <div class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                    {{ Str::limit($topQuestion->statement, 60) }}
                </div>
            @else
                <div class="text-2xl font-extrabold text-white mb-0.5">—</div>
                <div class="text-xs text-slate-500">Sem dados ainda</div>
            @endif
        </div>
    </div>

    {{-- ── QUESTIONS TABLE ─────────────────────────────────── --}}
    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden">

        {{-- Table Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-700">
            <div>
                <h2 class="text-white font-bold text-base">Banco de Questões</h2>
                <p class="text-slate-500 text-xs mt-0.5">{{ $questions->total() }} questões cadastradas</p>
            </div>
            <a href="{{ route('admin.questions.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition shadow-lg shadow-indigo-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Nova Questão
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-700 text-slate-400 text-xs uppercase tracking-wider">
                        <th class="px-6 py-3 text-left font-semibold w-12">#</th>
                        <th class="px-6 py-3 text-left font-semibold">Enunciado</th>
                        <th class="px-6 py-3 text-left font-semibold">Curso</th>
                        <th class="px-6 py-3 text-center font-semibold">Comp.</th>
                        <th class="px-6 py-3 text-center font-semibold">Ano</th>
                        <th class="px-6 py-3 text-center font-semibold w-12" title="Destaque na Prática Rápida">
                            <svg class="w-4 h-4 mx-auto text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </th>
                        <th class="px-6 py-3 text-center font-semibold">Resp.</th>
                        <th class="px-6 py-3 text-center font-semibold">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($questions as $question)
                        <tr class="hover:bg-slate-700/30 transition group">
                            <td class="px-6 py-4 text-slate-500 font-mono text-xs">{{ $question->id }}</td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-slate-200 font-medium line-clamp-2 leading-snug text-xs">
                                    {{ Str::limit($question->statement, 90) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-300 bg-slate-700 px-2.5 py-1 rounded-lg whitespace-nowrap">
                                    {{ Str::limit($question->course?->name ?? '—', 22) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-medium px-2 py-1 rounded-lg
                                    {{ $question->component === 'Específico' ? 'bg-violet-500/15 text-violet-400' : 'bg-slate-700 text-slate-400' }}">
                                    {{ $question->component === 'Específico' ? 'Esp.' : 'Geral' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-slate-400 text-xs font-mono">{{ $question->year }}</td>

                            {{-- Featured toggle --}}
                            <td class="px-6 py-4 text-center">
                                <form method="POST" action="{{ route('admin.questions.toggle-featured', $question) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            title="{{ $question->is_featured ? 'Remover destaque' : 'Destacar na Prática Rápida' }}"
                                            class="transition hover:scale-110">
                                        @if($question->is_featured)
                                            <svg class="w-5 h-5 text-amber-400 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-slate-600 hover:text-amber-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-mono {{ $question->times_answered > 0 ? 'text-emerald-400' : 'text-slate-600' }}">
                                    {{ number_format($question->times_answered) }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.questions.edit', $question) }}"
                                       class="inline-flex items-center gap-1.5 bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-400 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.questions.destroy', $question) }}"
                                          onsubmit="return confirm('Remover esta questão permanentemente?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5 bg-red-500/15 hover:bg-red-500/30 text-red-400 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Remover
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-slate-500">
                                Nenhuma questão cadastrada ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($questions->hasPages())
            <div class="px-6 py-4 border-t border-slate-700">
                {{ $questions->links() }}
            </div>
        @endif
    </div>

</x-admin-layout>
