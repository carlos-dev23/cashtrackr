@extends('Layouts.auth')
@section('title')
    Administra tus Presupuestos
@endsection
@section('auth-contents')
    @if (session('success'))
        <p class="my-10 text-center border border-green-400 bg-green-100 text-green-700 py-3 text-sm">
            {{ session('success') }}</p>
    @endif
    <p class="mt-5 text-lg">Tu cuenta fue creada con exito. Ahora solo debes confirmarla, revisa tu e-mail</p>
@endsection
