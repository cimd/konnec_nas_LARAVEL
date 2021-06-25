<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $table = "pkg_packages";
    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'category' => 'array',
        'has_config' => 'boolean',
        'can_remove' => 'boolean'
    ];

    public function dependency()
    {
        return $this->hasOne(PackageDependency::class, 'id', 'package_id');
    }
}