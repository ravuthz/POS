<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::login(factory(User::class)->create());
        $this->call(UserRolePermissionTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
