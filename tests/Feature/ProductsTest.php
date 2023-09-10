<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    public function test_get_data()
    {
        $response = $this->getJson("/api/products");

        $response->assertStatus(200)->assertJson(['msg' => true, 'data' => true]);
    }

    public function test_get_errors()
    {
        $response = $this->postJson('/api/product');

        $response->assertStatus(400)->assertJson(['msg' => true, 'error' => true]);
    }

    public function test_post_data()
    {
        $response = $this->postJson('/api/product', ["name" => "Product Test", "price" => 20000, "available_qty" => 10]);

        $response->assertStatus(200)->assertJson(['msg' => true, 'data' => true]);
    }
}
