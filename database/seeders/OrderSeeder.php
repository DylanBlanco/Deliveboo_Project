<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Order;
use App\Models\Restaurant;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Order::truncate();
        Schema::enableForeignKeyConstraints();


        for ($i = 0; $i < 10; $i++) {

            Order::create([
                // 'user_id' => auth()->id(),

                'name' => fake()->name(),
                'telephone' => fake()->sentence(),
                'email' => fake()->email(),
                'total_price' => fake()->randomFloat(2, 10, 500),
                'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            ]);
        }
    }
}
