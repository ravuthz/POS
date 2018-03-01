<?php

namespace App\Models;

use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingType extends Model
{
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'slug',
        'name',
        'name_kh',
        'image'
    ];

    public function settingItems()
    {
        return $this->hasMany(SettingItem::class);
    }
}
