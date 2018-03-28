<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderProductApiTest extends TestCase
{
    private $api = 'api/orders';
    private $jsonResource = [
        "data" => [
            "id",
            "ordered_by",
            "ordered_at",
            "created_by",
            "updated_by",
            "deleted_by",
            "created_at",
            "updated_at",
            "deleted_at"
        ]
    ];

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Auth::login(User::first());
    }

    public function getItems($update = 0)
    {
        return [
            'items' => [
                [
                    'id' => 1,
                    'qty' => 10 + $update,
                    'sale_price' => 100 + $update
                ],
                [
                    'id' => 2,
                    'qty' => 20 + $update,
                    'sale_price' => 200 + $update
                ],
                [
                    'id' => 3,
                    'qty' => 30 + $update,
                    'sale_price' => 300 + $update
                ]
            ]
        ];
    }

    public function testCreateOrders()
    {
        $data = $this->getItems();
        $response = $this->json('POST', $this->api, $data);
        $response->assertStatus(201);
        $response->assertJsonStructure($this->jsonResource);
    }

    public function testUpdateOrders()
    {
        $data = $this->getItems(100);
        $id = Order::first()->id;
        $response = $this->json('PATCH', $this->api . '/' . $id, $data);
        $response->assertStatus(200);
        $response->assertJsonStructure($this->jsonResource);
    }
}
