<?php

namespace App\Models;

use App\Models\SettingItem;
use App\Traits\CrudsModelTrait;
use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use App\Traits\SearchAndFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingType extends Model
{
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait;
    use CrudsModelTrait, SearchAndFilterTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'slug',
        'name',
        'name_kh',
        'image'
    ];

    protected $rules = [
        'name'    => 'required|unique:products,name,{id}',
        'name_kh' => 'required',
        'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    public function settingItems()
    {
        return $this->hasMany(SettingItem::class);
    }
}
