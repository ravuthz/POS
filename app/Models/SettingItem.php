<?php

namespace App\Models;

use App\Models\SettingType;
use App\Traits\CrudsModelTrait;
use App\Traits\FieldsAuditTrait;
use App\Traits\NameToSlugTrait;
use App\Traits\SearchAndFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingItem extends Model
{
    use CrudsModelTrait, SearchAndFilterTrait;
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

    protected $rules = [
        'name'            => 'required|unique:products,name,{id}',
        'name_kh'         => 'required',
        'setting_type_id' => 'required'
    ];

    public function settingType()
    {
        return $this->belongsTo(SettingType::class, 'setting_type_id');
    }
}
