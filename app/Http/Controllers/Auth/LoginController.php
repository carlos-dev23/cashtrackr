<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function store(SignInRequest $request)
    {
        $data = $request->validated();
        if (! Auth::attempt($data)) {
            return back()->with('error', 'Credenciales Incorrectas');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
