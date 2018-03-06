<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\CrudsModelTrait;
use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use App\Traits\SearchAndFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use CrudsModelTrait, SearchAndFilterTrait;
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait;
    protected $dates = ['deleted_at'];

    protected $rules = [
        'name'    => 'required|unique:products,name,{id}',
        'name_kh' => 'required',
        'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    protected $fillable = [
        'slug',
        'name',
        'name_kh',
        'image',
        'status',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Self::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
