<?php

namespace App\Models;

use App\Models\SettingType;
use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingItem extends Model
{
    use SoftDeletes, FieldsAuditTrait, NameToSlugTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'setting_type_id',
        'setting_type_model',
        'slug',
        'name',
        'name_kh',
        'value',
        'note'
    ];

    public function settingType()
    {
        return $this->belongsTo(SettingType::class, 'setting_type_id');
    }
}
