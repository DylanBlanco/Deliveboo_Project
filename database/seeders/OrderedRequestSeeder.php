<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\OrderedRequest;
use App\Models\Dish;
use App\Models\Order;


class OrderedRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        OrderedRequest::truncate();
        Schema::enableForeignKeyConstraints();


        for ($i = 0; $i < 10; $i++) {

            OrderedRequest::create([
                'order_id' => Order::inRandomOrder()->first()->id,
                'dish_id' => Dish::inRandomOrder()->first()->id,
                'quantity' => fake()->numberBetween(1, 10),
            ]);
        }
    }
}
