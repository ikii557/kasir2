<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(){
        return view("akun.register");
    }

    public function storeRegister(Request $request){
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user with the input data
        User::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password before storing
        ]);

        return redirect()->route('/login')->with('success', 'User created successfully.');
    }


    public function login(){
        return view("akun.login");
    }

    public function storeLogin(Request $request){
        // Validasi input login
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard setelah login sukses
            return redirect()->intended('/');
        } else {
            // Redirect kembali ke login dengan pesan error jika gagal
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        // Invalidasi session dan token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }
}
