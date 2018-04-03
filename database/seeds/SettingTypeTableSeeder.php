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

        SettingType::create([
            'slug' => 'movement',
            'name' => 'Movement',
            'name_kh' => 'Movement',
            'image' => 'movement.png',
            'note' => 'For Stock Movement'
        ]);

        SettingType::create([
            'slug' => 'order-type',
            'name' => 'Order Type',
            'name_kh' => 'Order Type',
            'image' => 'order-type.png',
            'note' => 'For Order Type'
        ]);
    }
}
