<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return redirect()->route('admin.login')
                ->with('error', 'Akses ditolak. Anda harus login sebagai admin.');
        }

        return $next($request);
    }
}
