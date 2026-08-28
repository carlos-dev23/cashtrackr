@extends('Layouts.auth')
@section('title')
    Crear cuenta
@endsection
@section('auth-contents')
    <form class="mt-14 space-y-5" novalidate method="POST" action={{ route('register.store') }}>
        <div class="space-y-2">
            <label class="font-bold text-2xl block" for="name">Nombre</label>

            <input id="name" type="text" placeholder="Tu Nombre"
                class="w-full border border-gray-300 @error('name') border-red-600 @enderror p-3 rounded-lg" name="name"
                value="{{ old('name') }}" />
            <x-input-error field="name" />
        </div>

        <div class="space-y-2">
            <label class="font-bold text-2xl block" for="email">Email</label>

            <input id="email" type="email" placeholder="Email de Registro"
                class="w-full border border-gray-300 @error('name') border-red-600 @enderror p-3 rounded-lg" name="email"
                value="{{ old('email') }}" autocomplete="off" />
            <x-input-error field="email" />
        </div>

        <div class="space-y-2">
            <label class="font-bold text-2xl block">Password</label>

            <input type="password" placeholder="Password de Registro"
                class="w-full border border-gray-300 @error('name') border-red-600 @enderror p-3 rounded-lg"
                name="password" />
            <x-input-error field="password" />
        </div>

        <div class="space-y-2">
            <label class="font-bold text-2xl block" for="password_confirmation">Repetir Password</label>

            <input type="password" placeholder="Password de Registro"
                class="w-full border border-gray-300 @error('name') border-red-600 @enderror p-3 rounded-lg"
                name="password_confirmation" />
            <x-input-error field="password_confirmation" />
        </div>

        <input type="submit" value='Registrarme'
            class="bg-purple-950 hover:bg-purple-800 w-full p-3 rounded-lg text-white font-bold  text-xl cursor-pointer" />
    </form>
@endsection
