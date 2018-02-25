<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['user'] = User::withRolePermission()->find(Auth::id())->toArray();
        $data['products'] = Product::all();
        return view('admin.index', $data);
    }
}
