<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\Authorizable;
use App\Traits\CrudsControllerTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use Authorizable;
    use CrudsControllerTrait;

    protected $itemName = 'role';
    protected $listName = 'roles';
    protected $modelPath = Role::class;
    protected $viewPrefix = 'roles';
    protected $routePrefix = 'roles';

    public function __construct()
    {
        try {
            $this->initialize();
            $this->setPageTitle("Role");
            $this->setSiteTitle("Roles");
        } catch (Exception $e) {
            Log::debug($e);
        }
    }

    /**
     * Override CrudController getFilterData
     * query all data with search form
     * @param null $request
     * @return mixed
     */
    public function getFilterData($request = null)
    {
        $this->data['permissions'] = Permission::all();
        return Role::all();
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        // admin role has everything
        if ($role->name === 'Admin') {
            $role->syncPermissions(Permission::all());
            return redirect()->route('roles.index');
        } else {
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', $role->name . ' permissions has been updated.');
    }
}
