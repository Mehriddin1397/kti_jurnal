<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Sizning hisobingiz faol emas.');
        }

        if (!in_array($user->role, ['superadmin', 'admin', 'editor', 'reviewer'])) {
            abort(403, 'Ruxsat berilmagan.');
        }

        return $next($request);
    }
}
