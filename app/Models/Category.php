<?php

namespace App\Models;

use Auth;
use App\Traits\FieldsAuditTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\NameToSlugTrait;

class Category extends Model
{
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'slug',
        'name',
        'image',
        'status',
        'parent_id'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
