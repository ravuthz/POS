<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleSeller = Role::create(['name' => 'seller']);
        $roleCustomer = Role::create(['name' => 'customer']);

        $cCreate = Permission::create(['name' => 'create category']);
        $cUpdate = Permission::create(['name' => 'update category']);
        $cDelete = Permission::create(['name' => 'delete category']);
        $cDetail = Permission::create(['name' => 'detail category']);

        $pCreate = Permission::create(['name' => 'create product']);
        $pUpdate = Permission::create(['name' => 'update product']);
        $pDelete = Permission::create(['name' => 'delete product']);
        $pDetail = Permission::create(['name' => 'detail product']);

        $uCreate = Permission::create(['name' => 'create user']);
        $uUpdate = Permission::create(['name' => 'update user']);
        $uDelete = Permission::create(['name' => 'delete user']);
        $uDetail = Permission::create(['name' => 'detail user']);

        $oCreate = Permission::create(['name' => 'create order']);
        $oUpdate = Permission::create(['name' => 'update order']);
        $oDelete = Permission::create(['name' => 'delete order']);
        $oDetail = Permission::create(['name' => 'detail order']);

        $sCreate = Permission::create(['name' => 'create stock']);
        $sUpdate = Permission::create(['name' => 'update stock']);
        $sDelete = Permission::create(['name' => 'delete stock']);
        $sDetail = Permission::create(['name' => 'detail stock']);

        $roleAdmin->givePermissionTo(
            $cCreate,
            $cUpdate,
            $cDelete,
            $cDetail,
            $pCreate,
            $pUpdate,
            $pDelete,
            $pDetail,
            $uCreate,
            $uUpdate,
            $uDelete,
            $uDetail,
            $oCreate,
            $oUpdate,
            $oDelete,
            $oDetail,
            $sCreate,
            $sUpdate,
            $sDelete,
            $sDetail
        );

        $roleSeller->givePermissionTo($oCreate,
            $oUpdate,
            $oDelete,
            $oDetail,
            $sCreate,
            $sUpdate,
            $sDelete,
            $sDetail
        );

        $roleCustomer->givePermissionTo(
            $cDetail,
            $pDetail,
            $uDetail,
            $oDetail,
            $sDetail
        );

        $admin = User::create([
            'name'     => 'adminz',
            'email'    => 'adminz@gmail.com',
            'password' => bcrypt('123123')
        ]);
        $admin->assignRole('admin');

        $author = User::create([
            'name'     => 'seller',
            'email'    => 'seller@gmail.com',
            'password' => bcrypt('123123')
        ]);
        $author->assignRole('seller');

        $editor = User::create([
            'name'     => 'customer',
            'email'    => 'customer@gmail.com',
            'password' => bcrypt('123123')
        ]);
        $editor->assignRole('customer');

    }
}
