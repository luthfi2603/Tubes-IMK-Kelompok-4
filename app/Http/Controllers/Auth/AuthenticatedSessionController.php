<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller {
    /**
     * Display the login view.
     */
    public function create(): View {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse {
        $request->authenticate();

        $request->session()->regenerate();

        $role = auth()->user()->status;
        switch($role){
            case "pasien":
                return redirect()->intended(route('pasien.dashboard'));
                break;
            case "dokter":
                return redirect()->intended(route('pasien.dashboard'));
                break;
            case "perawat":
                return redirect()->intended('/');
                break;
            case "admin":
                return redirect()->intended('/');
                break;
            default:
                return redirect()->intended('/');
                break;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Display the login view.
     */
    public function create0(): View {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store0(LoginRequest $request): RedirectResponse {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false))->with('notif', true);
    }
}