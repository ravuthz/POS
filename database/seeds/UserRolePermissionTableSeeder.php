<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        
        $user = $this->crudPermission('user');
        $category = $this->crudPermission('category');
        $product = $this->crudPermission('product');
        $order = $this->crudPermission('order');
        $stock = $this->crudPermission('stock');
        
        $roleAdmin->givePermissionTo(array_values($user));
        $roleAdmin->givePermissionTo(array_values($category));
        $roleAdmin->givePermissionTo(array_values($product));
        $roleAdmin->givePermissionTo(array_values($order));
        $roleAdmin->givePermissionTo(array_values($stock));

        $roleSeller->givePermissionTo(array_values($order));
        $roleSeller->givePermissionTo(array_values($stock));
        
        $roleCustomer->givePermissionTo(
            $user['detail'],
            $category['detail'],
            $product['detail'],
            $order['detail']
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
        
        $other = User::create([
            'name' => 'other',
            'email' => 'other@gmail.com',
            'password' => bcrypt('123123')
        ]);

    }
    
    protected function crudPermission($name) {
        $name = strtoupper($name);
        return [
            'create' => Permission::create(['name' => 'CREATE_' . $name, 'guard_name' => 'web']),
            'update' => Permission::create(['name' => 'UPDATE_' . $name, 'guard_name' => 'web']),
            'delete' => Permission::create(['name' => 'DELETE_' . $name, 'guard_name' => 'web']),
            'detail' => Permission::create(['name' => 'DETAIL_' . $name, 'guard_name' => 'web'])
        ];
    }
    
    
}
