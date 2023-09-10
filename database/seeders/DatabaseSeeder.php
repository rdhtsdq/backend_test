<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FlashSale;
use Illuminate\Database\Seeder;
use App\Models\Products;

class DatabaseSeeder extends Seeder
{
    protected $model = Products::class;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Products::factory(30)->create();
        FlashSale::factory(10)->create();
    }
}
