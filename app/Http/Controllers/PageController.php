<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    private static $validCredentials = [
        'email' => 'utspweb@gmail.com',
        'password' => '123',
        'name' => 'Steven'
    ];

    public static function getCredentials()
    {
        return self::$validCredentials;
    }

    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (Session::get('authenticated')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function dashboard()
    {
        // Cek session login
        if (!Session::get('authenticated')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }
        return view('dashboard');
    }

    // Proses login
    public function authenticate(Request $request)
    {
        $credentials = self::$validCredentials;

        if ($request->email === $credentials['email'] &&
            $request->password === $credentials['password']) {

            $request->session()->put([
                'authenticated' => true,
                'user_email' => $credentials['email'],
                'user_name' => $credentials['name']
            ]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'You have been logged out');
    }

    public function pengelolaan()
    {
        return view('pengelolaan', ['posts'=> [
            [
                'Gambar' => 'arabica.jpeg',
                'Stok' => '10',
                'Jenis Kopi' => 'Arabica Jember',
                'kualitas' => 'Grade A - 500gr',
                'Harga' => 'Rp 100.000'
            ],
            [
                'Gambar' => 'robusta.jpg',
                'Stok' => '12',
                'Jenis Kopi' => 'Robusta Bondowoso',
                'kualitas' => 'Grade 1 - 200gr',
                'Harga' => 'Rp 250.000'
            ],
            [
                'Gambar' => 'liberika.jpg',
                'Stok' => '3',
                'Jenis Kopi' => 'Liberika Pasuruan',
                'kualitas' => 'Special Edition - 400gr',
                'Harga' => 'Rp 650.000'
            ]
        ]]);
    }

    public function profile()
    {
        return view('profile');
    }
}

