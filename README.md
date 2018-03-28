AuditFields
- created_at
- updated_at
- deleted_at
- created_by
- updated_by
- deleted_by

Products
- id
- slug
- name
- note
- image
- status
- buy_price
- sale_price
- category_id
* AuditFields

Categories
- id
- slug
- name
- image
- status
- parent_id
* AuditFields

SettingTypes
- id
- slug
- image
- name_en
- name_kh
- note
* AuditFields

SettingItems
- id
- type_id
- type_model
- slug
- name
- name_kh
- value
- note
* AuditFields

Stocks
- id
- product_id
- quantity
- type (in / out)
* AuditFields

Order (=> Print Invoice)
- id
* AuditFields

OrderProduct
- order_id
- product_id
- price
- quantity



* User Role Permssion => Using Library


** NOTE
- slug for read on web and barcode reader

name ->unique() require
note -> nullable()->default(NULL)
id -> unsignedInteger()
price -> $table->decimal('price', 8, 2);
image -> $table->string('avatar')->default('default-name.jpg');
quantity->default(0)


php artisan make:factory ProductFactory
php artisan make:seeder 
php artisan make:test App\Models\ProductTestProductsTableSeeder

php artisan make:seeder StocksTableSeeder
php artisan make:resource StockResource
php artisan make:resource StockCollection --collection

php artisan make:seeder OrdersTableSeeder
php artisan make:resource OrderResource
php artisan make:resource OrderCollection --collection

php artisan make:controller OrdersController
php artisan make:test OrderProductApiTest


php artisan make:test SaleProductApiTest

cp .env.example .env.testing
mysql -u root -p -e "create database laravel_pos_test"

php artisan migrate --env=testing
php artisan migrate:fresh --seed --env=testing

vendor\bin\phpunit
vendor\bin\phpunit tests\Feature\SaleProductApiTest.php
vendor\bin\phpunit tests\Feature\OrderProductApiTest.php

vendor/bin/phpunit


php artisan make:controller Admin\OrderController

