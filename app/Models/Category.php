<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //TODO: Make NameToSlugTrait see \App\Traits\FieldsAuditTrait add content below
    //TODO: Use in Category, Product also SoftDeletes
    //TODO: Category Migration update follow README.md

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

}
