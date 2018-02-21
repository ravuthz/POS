<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->hasMany(Product::class);
    }
}
