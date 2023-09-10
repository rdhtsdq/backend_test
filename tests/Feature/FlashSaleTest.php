<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlashSaleTest extends TestCase
{
    public function test_get_flash_sale_product()
    {
        $response = $this->getJson('/api/flash');

        $response->assertStatus(200)->assertJson(['msg' => true, 'data' => true]);
    }
}
