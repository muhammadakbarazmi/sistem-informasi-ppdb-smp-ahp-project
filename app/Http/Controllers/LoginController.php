<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postregister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'level' => 'siswa',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('login')->with('success', 'Berhasil mendaftar, silahkan melakukan login!');
        // dd($request->all());
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->level == 'admin') {
                return view('admin.package.dashboard')->with('success', 'Selamat datang ' . auth()->user()->name);
            } elseif (auth()->user()->level == 'guru') {
                return view('guru.package.dashboard')->with('success', 'Selamat datang ' . auth()->user()->name);
            } elseif (auth()->user()->level == 'siswa') {
                return view('siswa.package.dashboard')->with('success', 'Selamat datang ' . auth()->user()->name);
            } else {
                return redirect('login');
            }
        }
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}