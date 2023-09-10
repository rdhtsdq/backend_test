<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Pest\Expectation;

class OrderTest extends TestCase
{
    public function test_fail_order()
    {
        $response = $this->postJson('/api/order');

        $response->assertStatus(400)->assertJson(['msg' => true, 'error' => true]);
    }

    public function test_success_order()
    {
        $response = $this->postJson('/api/order', ['product_id' => 16, 'qty' => 10]);
        $response2 = $this->postJson('/api/order', ['product_id' => 16, 'qty' => 10]);
        $response->assertStatus(200)->assertJson(['msg' => true]);
        $response2->assertStatus(200)->assertJson(['msg' => true]);
    }
}
