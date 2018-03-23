<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SaleProductApiTest extends TestCase
{
    private $api = 'api/sales';

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Auth::login(User::first());
    }

    public function testCreateSales()
    {
        $data = [
            'items' => [
                [
                    'id' => 1,
                    'qty' => 10,
                    'sale_price' => 100
                ],
                [
                    'id' => 2,
                    'qty' => 20,
                    'sale_price' => 200
                ],
                [
                    'id' => 3,
                    'qty' => 30,
                    'sale_price' => 300
                ]
            ]
        ];

        $response = $this->json('POST', $this->api, $data);
        $response->assertStatus(201);
    }
}