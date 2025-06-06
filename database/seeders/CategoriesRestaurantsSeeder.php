<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesRestaurantsSeeder extends Seeder
{
    public function run(): void
    {
        // Disabilita i vincoli di chiave esterna per evitare errori
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories_restaurants')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('categories_restaurants')->insert([
            ['restaurant_id' => 1, 'category_id' => 4], // Ristorante 1 -> Categoria 4 cinese
            ['restaurant_id' => 2, 'category_id' => 2], // Ristorante 2 -> Categoria 2 Giapponese
            ['restaurant_id' => 3, 'category_id' => 2], // Ristorante 3 -> Categoria 2 Giapponese
            ['restaurant_id' => 3, 'category_id' => 4], // Ristorante 3 -> Categoria 4 cinese
            ['restaurant_id' => 4, 'category_id' => 3], // Ristorante 4 -> Categoria Messicano
            ['restaurant_id' => 5, 'category_id' => 1], // Ristorante 5 -> Categoria Italiano
            ['restaurant_id' => 6, 'category_id' => 2], // Ristorante 6 -> Categoria Giapponese
            ['restaurant_id' => 6, 'category_id' => 5], // Ristorante 6 -> Categoria Indiano
            ['restaurant_id' => 7, 'category_id' => 1], // Ristorante 7 -> Categoria Italiano
            ['restaurant_id' => 8, 'category_id' => 5], // Ristorante 8 -> Categoria Indiano
            ['restaurant_id' => 9, 'category_id' => 1], // Ristorante 9 -> Categoria italiano
            ['restaurant_id' => 10, 'category_id' => 6], // Ristorante 10 -> Categoria Francese
        ]);
    }
}
