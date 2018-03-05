<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    public function scopeGetCustomer($query)
    {
        return $query->where('name', 'customer')->first();
    }
    
    public function scopeWithRolePermission($q)
    {
        return $this->with(['roles' => function($query) {
            $query->select('id', 'name')->with(['permissions' => function($q) {
                $q->select('id', 'name');
            }]);
        }]);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'created_by');
    }
    
}
