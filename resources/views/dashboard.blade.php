@extends('Layouts.auth')
@section('title')
    Administra tus Presupuestos
@endsection
@section('auth-contents')
    @if (session('success'))
        <x-alert :message="session('success')" />
    @endif
    <p class="mt-5 text-lg">Tu cuenta fue creada con exito. Ahora solo debes confirmarla, revisa tu e-mail</p>
@endsection
