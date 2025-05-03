<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman Login
    public function loginPage()
    {
        return view('auth.login');
    }

    // Proses Login
    public function loginAction(Request $request)
    {
        $rules = [
            'email_or_username' => 'required',
            'password' => 'required|min:6',
        ];

        $messages = [
            'email_or_username.required' => 'Email/Username harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari :min karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the input is email or username
        $loginField = filter_var($request->email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->email_or_username,
            'password' => $request->password,
        ];

        if ($request->remember != null) {
            Cookie::queue('emailCookie', $request->email_or_username, 30);
        }

        if (Auth::attempt($credentials, true)) {
            $user = DB::table('users')->where($loginField, '=', $request->email_or_username)->first();

            if ($user->is_active == 0) {
                return back()->withErrors(['message' => 'Tidak ada akses login']);
            }

            session()->put('currUserSession', $user);

            return redirect(route('homepage'))->with('message', 'Berhasil login sebagai ' . $user->username . '.');
        }

        return back()
            ->withErrors(['message' => 'Email atau Username belum terdaftar!'])
            ->withInput();
    }

    // Halaman Register
    public function registerPage()
    {
        return view('auth.register');
    }

    // Proses Register
    public function registerAction(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];

        $messages = [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus dalam format yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password harus diisi.',
            'password_confirmation.min' => 'Konfirmasi password minimal harus terdiri dari :min karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan data pengguna baru
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash password
        $user->is_active = 1; // Status aktifkan akun
        $user->role_id = 2; // Menetapkan role_id ke 2
        $user->save();

        // Setelah berhasil registrasi, login otomatis dan arahkan ke halaman login
        Auth::login($user);

        return redirect(route('login.page'))->with('message', 'Berhasil register dan login sebagai ' . $user->username . '.');
    }

    // Logout
    public function logout()
    {
        $user = Auth::user();

        Auth::logout();

        session()->flush();

        return redirect(route('login.page'))->with('message', 'Berhasil logout dari ' . $user->username . '.');
    }
}
