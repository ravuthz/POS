<?php

namespace App\Models;

use App\Traits\CrudsModelTrait;
use App\Traits\SearchAndFilterTrait;

class Permission extends \Spatie\Permission\Models\Permission
{
    use CrudsModelTrait, SearchAndFilterTrait;

    protected $fillable = [
        'name', 'guard_name'
    ];

    public $rules = [

    ];

    public static function defaultPermissions()
    {
        return [
            'CREATE_USER',
            'UPDATE_USER',
            'DETAIL_USER',
            'DELETE_USER',

            'CREATE_ROLE',
            'UPDATE_ROLE',
            'DETAIL_ROLE',
            'DELETE_ROLE',

            'CREATE_PERMISSION',
            'UPDATE_PERMISSION',
            'DETAIL_PERMISSION',
            'DELETE_PERMISSION',
        ];
    }
}
