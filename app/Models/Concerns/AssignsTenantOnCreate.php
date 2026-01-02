<?php
//Auto asigna tenant id para products y demas
namespace App\Models\Concerns;

trait AssignsTenantOnCreate
{
    protected static function bootAssignsTenantOnCreate()
    {
        static::creating(function ($model) {
            if (! tenant()) {
                return;
            }

            if ($model->tenant_id) {
                return;
            }

            $model->tenant_id = tenant()->id;
        });
    }
}
