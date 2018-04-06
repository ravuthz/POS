<?php

use App\Models\SettingItem;
use App\Models\SettingType;
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

        $movement = SettingType::where('slug', 'movement')->first();
        $orderType = SettingType::where('slug', 'order-type')->first();

        SettingItem::create([
            'setting_type_id' => $movement->id,
            'setting_type_model' => 'no',
            'slug' => 'in',
            'name' => 'In',
            'name_kh' => 'ចូល',
            'value' => 'in',
            'note' => 'For Stock Movement In'
        ]);

        SettingItem::create([
            'setting_type_id' => $movement->id,
            'setting_type_model' => 'no',
            'slug' => 'out',
            'name' => 'Out',
            'name_kh' => 'ចេញ',
            'value' => 'out',
            'note' => 'For Stock Movement Out'
        ]);

        SettingItem::create([
            'setting_type_id' => $orderType->id,
            'setting_type_model' => 'no',
            'slug' => 'cancel',
            'name' => 'Cancel',
            'name_kh' => 'មិនយក',
            'value' => '0',
            'note' => 'For Order type is cancel'
        ]);

        SettingItem::create([
            'setting_type_id' => $orderType->id,
            'setting_type_model' => 'no',
            'slug' => 'booked',
            'name' => 'Booked',
            'name_kh' => 'បានកក់​',
            'value' => '1',
            'note' => 'For Order type is booked'
        ]);

        SettingItem::create([
            'setting_type_id' => $orderType->id,
            'setting_type_model' => 'no',
            'slug' => 'sold',
            'name' => 'Sold',
            'name_kh' => 'បានលក់',
            'value' => '1',
            'note' => 'For Order type is sold'
        ]);

        SettingItem::create([
            'setting_type_id' => $orderType->id,
            'setting_type_model' => 'no',
            'slug' => 'other',
            'name' => 'Other',
            'name_kh' => 'ផ្សេងៗ',
            'value' => 'other',
            'note' => 'For Order type is other'
        ]);
    }
}
