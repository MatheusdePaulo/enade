<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $courses = Course::orderBy('name')->get();
        return view('auth.register', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome'        => ['required', 'string', 'max:100'],
            'sobrenome'   => ['required', 'string', 'max:100'],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'course_id'   => ['nullable', 'exists:courses,id'],
            'institution' => ['nullable', 'string', 'max:255'],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'        => trim($request->nome . ' ' . $request->sobrenome),
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'course_id'   => $request->course_id ?: null,
            'institution' => $request->institution,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
