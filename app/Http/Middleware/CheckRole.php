<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response {
        if(in_array($request->user()->status, $roles)){
            if(!$request->user()->aktif){
                Auth::guard('web')->logout();
    
                $request->session()->invalidate();
    
                $request->session()->regenerateToken();
    
                return redirect()->route('login')->with('failed', 'Mohon maaf, akun anda sudah diblokir, pergi ke admin untuk informasi lebih lanjut');
            }

            return $next($request);
        }

        abort(403);
    }
}