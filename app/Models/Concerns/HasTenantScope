<?php
//Solo filtra para User
namespace App\Models\Concerns;

use App\Models\Scopes\TenantScope;

trait HasTenantScope
{
    protected static function bootHasTenantScope()
    {
        static::addGlobalScope(new TenantScope);
    }
}
