<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Traits\Authorizable;
use App\Traits\CrudsControllerTrait;
use Exception;

class PermissionController extends Controller
{
    use Authorizable;
    use CrudsControllerTrait;

    protected $itemName = 'permission';
    protected $listName = 'permissions';
    protected $modelPath = Permission::class;
    protected $viewPrefix = 'admin.permissions';
    protected $routePrefix = 'permissions';

    public function __construct()
    {
        try {
            $this->initialize();
            $this->setPageTitle("Permission");
            $this->setSiteTitle("Permissions");
        } catch (Exception $e) {
            Log::debug($e);
        }
    }
}
