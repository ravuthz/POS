<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $data['user'] = User::withRolePermission()->find(Auth::id())->toArray();
        return view('admin.index', $data);
    }
}
