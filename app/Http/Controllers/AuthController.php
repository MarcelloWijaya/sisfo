<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
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
        $loginField = filter_var($request->email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

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

            return redirect(route('homepage'))->with('message', 'Berhasil login sebagai ' . $user->name . '.');
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
            'name' => 'required|unique:users,name|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];

        $messages = [
            'name.required' => 'Username harus diisi.',
            'name.unique' => 'Username sudah terdaftar.',
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_active = 1;
        $user->role_id = 2; // Default role_id = 2 (admin)
        $user->save();

        return redirect(route('login.page'))->with('success', 'Berhasil register. Silakan login.');
    }

    // Logout
    public function logout()
    {
        $user = Auth::user();
        $username = $user->name ?? 'User';

        Auth::logout();
        session()->flush();

        return redirect(route('login.page'))->with('success', 'Berhasil logout dari ' . $username . '.');
    }

    // ==============================================
    // PROFILE METHODS
    // ==============================================

    /**
     * Show profile page
     */
    public function profile()
    {
        $user = Auth::user();
        $user->load('role', 'branch'); // Eager loading relasi

        return view('profile.index', [
            'user' => $user,
            'title' => 'My Profile',
        ]);
    }

    /**
     * Update profile information
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->updated_by = $user->name;
        $user->save();

        // Update session
        session()->put('currUserSession', $user);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required|min:6',
        ];

        $messages = [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 6 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()
                ->back()
                ->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->updated_by = $user->name;
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    /**
     * Show activity log page
     */
    public function activityLog()
    {
        // You can create an activity_logs table to track user activities
        // For now, return view with user login history from session or logs

        $user = Auth::user();

        // Get user login history if you have a table
        // $activities = ActivityLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('profile.activity', [
            'user' => $user,
            'title' => 'Activity Log',
        ]);
    }

    /**
     * Get user settings page
     */
    public function settings()
    {
        $user = Auth::user();

        return view('profile.settings', [
            'user' => $user,
            'title' => 'Account Settings',
        ]);
    }
}
