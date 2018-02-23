<?php

namespace Tests\Feature\App\Models;

use Auth;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;
    public function setUp()
    {
        parent::setUp();
        Category::truncate();
        Auth::login(factory(User::class)->create());
        factory(Category::class)->create();
        factory(Category::class)->create();
        factory(Category::class)->create();
    }
    public function testCreateCategory()
    {
        factory(Category::class)->create(['name' => 'category 1']);
        $this->assertDatabaseHas('categories', ['name' => 'category 1', 'slug' => 'category-1']);
    }
}
