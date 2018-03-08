<?php

namespace App\Models;

use App\Traits\CrudsModelTrait;
use App\Traits\SearchAndFilterTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    use CrudsModelTrait, SearchAndFilterTrait;

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

    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,{id}',
        'password' => 'required|string|min:6|confirmed',
        'roles' => 'required|min:1'
    ];

    public function scopeGetCustomer($query)
    {
        return $query->where('name', 'customer')->first();
    }

    public function scopeWithRolePermission($q)
    {
        return $this->with(['roles' => function ($query) {
            $query->select('id', 'name')->with(['permissions' => function ($q) {
                $q->select('id', 'name');
            }]);
        }]);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'created_by');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Override CrudModel
     * @param null $request
     */
    public function saveOrUpdate($request)
    {
        $data = $request->except('roles', 'permissions', 'password');
        if (!$request->isMethod('post')) {
            if ($request->get('password')) {
                $this->password = $request->get('password');
            }
        } else {
            $this->password = $request->get('password');
        }

        $this->fill($data)->save();
        $this->syncPermissions($request);
    }

    private function syncPermissions(Request $request)
    {
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        $roles = Role::find($roles);

        if (!$this->hasAllRoles($roles)) {
            $this->permissions()->sync([]);
        } else {
            $this->syncPermissions($permissions);
        }

        $this->syncRoles($roles);
        return $this;
    }
}
