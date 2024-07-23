<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

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
        $message = [
            'required' => ':attribute harus diisi',
        ];
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], $message);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if($user->role == 'administrator'){
                return redirect()->intended('beranda');
            }else{
                return redirect()->intended('user');
            }
        } else {
            Session::flash('error_login', 'Login Failed');
            return redirect('/');
        }
    }
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maximal 255 kata/angka',
            'min' => ':attribute minimal 2 kata/angka',
            'email' => ':attribute tidak valid',
        ];
        $validateData = $request->validate([
            'name' => 'required|max:255|min:2',
            'username' => 'required|max:255|min:5',
            'email' => 'required|email:dns|unique:App\Models\User,email',
            'password' => 'required|min:5|max:255|confirmed',
            'role' => '',
        ], $message);
        // event(new Registered($validateData));
        $validateData['password'] = Hash::make($validateData['password']);
        $user = User::create($validateData);
        // event(new Registered($user));
        // Auth::login($user);
        return redirect('/');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
