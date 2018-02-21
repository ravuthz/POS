<?php

use App\Models\SettingType;
use Illuminate\Database\Seeder;

class SettingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SettingType::class, 10)->create()->each(function ($settingItem) {
            $settingItem->settingItems()->save(factory(App\Models\SettingItem::class)->make());
        });
    }
}
