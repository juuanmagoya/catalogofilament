<?php

namespace App\Models\Concerns;
//Todas las querys filtran por tenant_id automaticamente
//automaticamente asigna tenant_id al crear un modelo
use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;

trait HasTenantScope
{
    protected static function bootHasTenantScope(): void
    {
        static::addGlobalScope(new TenantScope);
    }

    protected static function booted()
    {
        static::creating(function (Model $model) {
            if (
                tenant()
                && empty($model->tenant_id)
                && ! $model instanceof \App\Models\User
                ) {
                    $model->tenant_id = tenant()->id;
                }
        });

    }
}
