<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\HasTenantScope;
use App\Models\Concerns\BelongsToTenant;

class Category extends Model
{
    use HasFactory;
    use HasTenantScope, BelongsToTenant;

    protected $fillable = ['name'];
}
