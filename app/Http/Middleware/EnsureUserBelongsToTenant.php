<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserBelongsToTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Todavía no autenticado (login, assets, etc.)
        if (! $user) {
            return $next($request);
        }

        $tenant = tenant();

        // No debería pasar, pero blindamos
        if (! $tenant) {
            Auth::logout();
            abort(403, 'Tenant inválido');
        }

        // Usuario no pertenece al tenant del subdominio
        if ($user->tenant_id !== $tenant->id) {
            Auth::logout();
            abort(403, 'No perteneces a este tenant');
        }

        return $next($request);
    }
}
