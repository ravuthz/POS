<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\Authorizable;
use App\Traits\CrudsControllerTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use Authorizable;
    use CrudsControllerTrait;

    protected $itemName = 'user';
    protected $listName = 'users';
    protected $modelPath = User::class;
<<<<<<< HEAD
    protected $viewPrefix = 'users';
=======
    protected $viewPrefix = 'admin.users';
>>>>>>> e924bb970cd7bfd1f80755a58e2ac52be68b2887
    protected $routePrefix = 'users';

    public function __construct()
    {
        try {
            $this->initialize();
            $this->setPageTitle("User");
            $this->setSiteTitle("Users");
            $this->data['roles'] = Role::pluck('name', 'id');
            $this->data['permissions'] = Permission::all('name', 'id');
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
        $name = $request->get('name', '');
        return User::searchName($name)->latest()->paginate(10);
    }

    /**
     * Override CrudController destroy
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->back()
                ->with('warning', 'Deletion of currently logged in user is not allowed :(');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()
            ->with('success', 'The user with id = ' . $id . ' delete successfully :D');
    }
}
