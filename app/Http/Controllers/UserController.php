<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        if (Auth::check()) {
            return redirect('/beranda');
        } else {
            return view('login', $data);
        }
    }
    public function register()
    {
        $data['title'] = 'Registrasi';
        return view('register', $data);
    }
    public function authenticate(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($data)) {
            // $request->session()->regenerate();
            return redirect()->intended('/beranda');
        } else {
            return "Login gagal";
        }
    }
}
