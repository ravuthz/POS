<?php

use App\Models\SettingItem;
use Illuminate\Database\Seeder;

class SettingItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SettingItem::class, 10)->create();
    }
}
