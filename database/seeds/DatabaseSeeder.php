<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user  = User::create([
            'name' => 'AdminZee',
            'email' => 'admin-zee@gmaail.com',
            'password' => bcrypt('123123')
        ]);

        Auth::login($user);
        $this->call(UserRolePermissionTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SettingTypeTableSeeder::class);
        $this->call(SettingItemTableSeeder::class);

//        $this->call(OrdersTableSeeder::class);
//        $this->call(StocksTableSeeder::class);
    }
}
