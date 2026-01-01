<?php
namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class ResolveTenant
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $parts = explode('.', $host);

        // Si no hay subdominio (ej: localhost)
        if (count($parts) < 3) {
            app()->instance('tenant', null);
            return $next($request);
        }

        $subdomain = $parts[0];

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
?>