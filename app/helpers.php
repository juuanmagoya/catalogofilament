<?php
use App\Models\Tenant;

function tenant(): ?Tenant
{
    return app()->has('tenant') ? app('tenant') : null;
}
?>