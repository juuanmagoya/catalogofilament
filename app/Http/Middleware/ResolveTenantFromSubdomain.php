<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenantFromSubdomain
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        // Caso localhost sin subdominio real
        if (in_array($subdomain, ['localhost', '127', 'www'])) {
            abort(404);
        }

        $tenant = Tenant::where('subdomain', $subdomain)
            ->where('is_active', true)
            ->first();

        if (! $tenant) {
            abort(404, 'Tenant no encontrado');
        }

        app()->instance('tenant', $tenant);

        return $next($request);
    }
}
