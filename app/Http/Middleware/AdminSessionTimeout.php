<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('admin')) {
            $expiresAt = session('expires_at', 0);

            if (now()->timestamp > $expiresAt) {
                session()->flush();
                return redirect()->route('loginform')->withErrors([
                    'login_error' => 'Session expired. Please login again.'
                ]);
            }
        }

        return $next($request);
    }
}
