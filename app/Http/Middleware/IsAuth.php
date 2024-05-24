<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if(Auth::check()){
            $role = Auth::user()->status;

            switch($role){
                case 'Pasien':
                    return redirect()->route('pasien.dashboard');
                case 'Dokter':
                    return redirect()->route('dokter.dashboard');
                case 'Perawat':
                    return redirect()->route('perawat.dashboard');
                case 'Admin':
                    return redirect()->route('admin.dashboard');
                default:
                    abort(404);
            }
        }

        return $next($request);
    }
}