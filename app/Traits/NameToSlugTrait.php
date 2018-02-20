<?php

namespace App\Traits;

use Auth;

trait NameToSlugTrait
{
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
