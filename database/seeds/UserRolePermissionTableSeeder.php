<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some users
        $admin = User::fixedUser('admin');
        $seller = User::fixedUser('seller');
        $customer = User::fixedUser('customer');

        // Create default roles
        $roles = Role::defaultRoles();
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Create default permissions
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create other permissions
        $this->crudPermission('category');
        $this->crudPermission('product');
        $this->crudPermission('order');
        $this->crudPermission('stock');
        $this->crudPermission('settingitem');
        $this->crudPermission('settingtype');

        $roleAdmin = Role::whereName('admin')->first();
        $roleSeller = Role::whereName('seller')->first();
        $roleCustomer = Role::whereName('customer')->first();

        // Assign all permissions to admin role
        if ($roleAdmin) {
            $permissions = Permission::all();
            dump("Role Admin's Permission");
            dump($permissions->toArray());
            $roleAdmin->syncPermissions($permissions);
        }

        // Assign some permissions to seller role
        if ($roleSeller) {
            $permissions = Permission
                ::where('name', 'like', '%_PRODUCT')
                ->orWhere('name', 'like', '%_CATEGORY')
                ->orWhere('name', 'like', '%_ORDER')
                ->orWhere('name', 'like', '%_STOCK')
                ->get();
            dump("Role Seller's Permission");
            dump($permissions->toArray());
            $roleSeller->givePermissionTo($permissions);
        }

        // Assign all detail permissions to customer role
        if ($roleCustomer) {
            $permissions = Permission::where('name', 'like', 'DETAIL_%')->get();
            dump("Role Customer's Permission");
            dump($permissions->toArray());
            $roleCustomer->syncPermissions($permissions);
        }

        // Assign roles to users
        $admin->assignRole('admin');
        $seller->assignRole('seller');
        $customer->assignRole('customer');

    }

    protected function crudPermission($name)
    {
        $name = strtoupper($name);
        return [
            'create' => Permission::create(['name' => 'CREATE_' . $name, 'guard_name' => 'web']),
            'update' => Permission::create(['name' => 'UPDATE_' . $name, 'guard_name' => 'web']),
            'delete' => Permission::create(['name' => 'DELETE_' . $name, 'guard_name' => 'web']),
            'detail' => Permission::create(['name' => 'DETAIL_' . $name, 'guard_name' => 'web'])
        ];
    }
}
