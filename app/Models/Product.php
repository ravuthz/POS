<?php

namespace App\Models;

use App\Models\Category;
use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use App\Traits\SearchAndFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait, SearchAndFilterTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'slug',
        'name',
        'name_kh',
        'image',
        'status',
        'buy_price',
        'sale_price',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
