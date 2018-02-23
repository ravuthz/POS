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
        Auth::login(factory(User::class)->create());
        $this->call(UserRolePermissionTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SettingTypeTableSeeder::class);
        $this->call(SettingItemTableSeeder::class);
    }
}
