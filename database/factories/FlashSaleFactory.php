<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FlashSale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FlashSale>
 */
class FlashSaleFactory extends Factory
{
    protected $model = FlashSale::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 30)
        ];
    }
}
