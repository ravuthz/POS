<?php

namespace App\Traits;

use App\Models\User;
use Auth;

trait FieldsAuditTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::user()->id;
            return $model->save() ? true : false;
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function createdDate($format = 'd/m/Y')
    {
        return $this->created_at->format($format);
    }

    public function createdUser($field = 'name')
    {
        return $this->createdBy->$field;
    }

}
