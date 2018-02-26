<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Auth;

class AdminController extends Controller
{
    public function __constuct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $data['user'] = User::withRolePermission()->find(Auth::id())->toArray();
        $data['products'] = Product::all();
        return view('admin.index', $data);
    }

    public function products()
    {
        return Product::paginate(12);
    }
}
