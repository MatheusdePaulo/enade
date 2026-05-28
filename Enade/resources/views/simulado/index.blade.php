<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">Novo Simulado</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-8 py-8">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h1 class="text-2xl font-extrabold text-white mb-2">Configure seu Simulado</h1>
                    <p class="text-indigo-200 text-sm">Personalize as questões e teste seus conhecimentos com tempo cronometrado.</p>
                </div>

                <form action="{{ route('simulado.iniciar') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Curso <span class="text-slate-400 font-normal">(opcional)</span></label>
                        @if($courses->count() > 0)
                            <select name="course_id" class="w-full rounded-xl border-slate-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                <option value="">Todos os cursos</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" @selected($userCourseId == $course->id)>
                                        {{ $course->name }} ({{ $course->questions_count }} questões)
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <div class="flex items-center gap-3 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-700">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Nenhum curso cadastrado ainda. O simulado usará questões de todos os cursos disponíveis.
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Componente</label>
                            <select name="component" class="w-full rounded-xl border-slate-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                <option value="">Geral e Específico</option>
                                <option value="Geral">Formação Geral</option>
                                <option value="Específico">Componente Específico</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Ano <span class="text-slate-400 font-normal">(opcional)</span></label>
                            <select name="year" class="w-full rounded-xl border-slate-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                <option value="">Todos os anos</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Quantidade de questões
                        </label>
                        <div class="grid grid-cols-4 gap-3">
                            @foreach([5, 10, 20, 30] as $n)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="quantidade" value="{{ $n }}" class="sr-only peer" @if($n === 10) checked @endif>
                                    <div class="text-center py-3 rounded-xl border-2 border-slate-200 text-slate-600 text-sm font-semibold
                                                peer-checked:border-indigo-600 peer-checked:bg-indigo-600 peer-checked:text-white
                                                hover:border-indigo-400 transition">
                                        {{ $n }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-slate-400 mt-2">Você terá 1 hora para concluir o simulado.</p>
                    </div>

                    @if($courses->count() === 0 && $years->count() === 0)
                        <div class="p-5 bg-slate-50 rounded-xl border border-slate-200 text-center">
                            <p class="text-slate-500 text-sm">
                                <strong class="text-slate-700">Banco de questões vazio.</strong><br>
                                Cadastre questões antes de iniciar um simulado.
                            </p>
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-xl transition flex items-center justify-center gap-2 text-base shadow-lg shadow-indigo-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Iniciar Simulado
                    </button>
                </form>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('dashboard') }}" class="text-sm text-slate-400 hover:text-slate-600 transition">← Voltar à Página Inicial</a>
            </div>
        </div>
    </div>
</x-app-layout>
