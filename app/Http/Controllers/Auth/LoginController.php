<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Default redirect for bloggers.
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle actions after user is authenticated.
     */
    protected function authenticated($request, $user)
    {
        // ❌ Block disabled users
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Your account has been disabled by the admin.',
                ]);
        }

        // 🔹 Role-based redirection
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // your custom admin dashboard
        }

        // 🔹 Bloggers use default $redirectTo (/home)
        return redirect()->intended($this->redirectPath());
    }
}
