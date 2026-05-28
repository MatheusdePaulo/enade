<x-guest-layout>

    <div class="mb-7">
        <h1 class="text-2xl font-extrabold text-slate-900">Criar sua conta</h1>
        <p class="text-slate-500 text-sm mt-1">Preencha os dados abaixo para começar a estudar.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Nome + Sobrenome --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="nome" class="block text-sm font-semibold text-slate-700 mb-1.5">Nome <span class="text-red-400">*</span></label>
                <input id="nome" type="text" name="nome" value="{{ old('nome') }}"
                       required autofocus placeholder="João"
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('nome') border-red-400 @enderror">
                @error('nome')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="sobrenome" class="block text-sm font-semibold text-slate-700 mb-1.5">Sobrenome <span class="text-red-400">*</span></label>
                <input id="sobrenome" type="text" name="sobrenome" value="{{ old('sobrenome') }}"
                       required placeholder="Silva"
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('sobrenome') border-red-400 @enderror">
                @error('sobrenome')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- E-mail --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">E-mail <span class="text-red-400">*</span></label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       required autocomplete="username" placeholder="seu@email.com"
                       class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('email') border-red-400 @enderror">
            </div>
            @error('email')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Curso --}}
        <div>
            <label for="course_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Curso</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <select id="course_id" name="course_id"
                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition appearance-none bg-white @error('course_id') border-red-400 @enderror">
                    <option value="">Selecionar curso (opcional)</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('course_id')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Instituição --}}
        <div>
            <label for="institution" class="block text-sm font-semibold text-slate-700 mb-1.5">Instituição de Ensino</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <input id="institution" type="text" name="institution" value="{{ old('institution') }}"
                       placeholder="Ex: Universidade Federal de São Paulo"
                       class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('institution') border-red-400 @enderror">
            </div>
            @error('institution')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Senha --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Senha <span class="text-red-400">*</span></label>
                <input id="password" type="password" name="password"
                       required autocomplete="new-password" placeholder="Mín. 8 caracteres"
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('password') border-red-400 @enderror">
                @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Confirmar <span class="text-red-400">*</span></label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       required autocomplete="new-password" placeholder="Repita a senha"
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
            </div>
        </div>

        {{-- Botão --}}
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-lg shadow-indigo-500/20 flex items-center justify-center gap-2 mt-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Criar conta gratuitamente
        </button>
    </form>

    <p class="mt-5 text-center text-sm text-slate-500">
        Já tem uma conta?
        <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
            Fazer login
        </a>
    </p>

</x-guest-layout>
