<?php

namespace App\Models;

use App\Traits\CrudsModelTrait;

class Role extends \Spatie\Permission\Models\Role
{
    use CrudsModelTrait;

    protected $rules = [
        'name'       => 'required||max:25',
        'guard_name' => 'required'
    ];
}
