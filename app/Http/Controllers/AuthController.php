<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $rules = [
            'email' => 'required|email|ends_with:anaku.com',
            'password' => 'required|min:6',
        ];

        $messages = [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang valid.',
            'email.ends_with' => 'Email harus menggunakan domain "anaku.com".',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari :min karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if ($request->remember != null) {
            Cookie::queue('emailCookie', $request->email, 30);
        }

        if (Auth::attempt($credentials, true)) {
            $user = DB::table('users')->where('email', '=', $request->email)->first();

            if ($user->is_active == 0) {
                return back()->withErrors(['message' => 'Tidak ada akses login']);
            }

            session()->put('currUserSession', $user);

            return redirect(route('homepage'))->with('message', 'Berhasil login sebagai ' . $user->username . '.');
        }

        return back()->withErrors(['message' => 'Email belum terdaftar!'])->withInput();
    }

    public function logout()
    {
        $user = Auth::user();

        Auth::logout();

        session()->flush();

        return redirect(route('login.page'))->with('message', 'Berhasil logout dari ' . $user->username . '.');
    }
}
