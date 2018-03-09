<?php

namespace App\Models;

use App\Traits\CrudsModelTrait;

class Role extends \Spatie\Permission\Models\Role
{
    use CrudsModelTrait;

    protected $fillable = ['name', 'guard_name'];
    public $rules = ['name' => 'required|unique:roles'];

    public static function defaultRoles()
    {
        return ['admin', 'seller', 'customer'];
    }
}
