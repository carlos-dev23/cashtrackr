@extends('Layouts.base')
@section('contents')
    <main class="max-w-2xl mt-10 mx-auto p-10 shadow-2xl">
        <h1 class="text-bold text-4xl">@yield('title')</h1>
        @yield('auth-contents')
    </main>
@endsection
