<?php

namespace App\Models;

use Auth;
use App\Traits\FieldsAuditTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\NameToSlugTrait;
use App\Models\Category;

class Product extends Model
{
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'slug',
        'name',
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
