<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Category;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        // Disabilita vincoli e reset dei dati
        Schema::disableForeignKeyConstraints();
        Dish::truncate();
        Schema::enableForeignKeyConstraints();

        // Recupera tutti i ristoranti
        $restaurants = Restaurant::all();

        // Recupera i piatti dalla configurazione
        $allDishes = config('dishes');

        foreach ($restaurants as $restaurant) {
            // Recupera tutte le categorie associate al ristorante
            $categories = $restaurant->categories;

            if ($categories->isEmpty()) {
                // Salta il ristorante se non ha categorie
                continue;
            }

            foreach ($categories as $category) {
                // Filtra i piatti in base alla categoria
                $dishesForCategory = collect($allDishes)->filter(function ($dish) use ($category) {
                    return $dish['category_id'] == $category->id;
                });

                // Crea i piatti per il ristorante
                foreach ($dishesForCategory as $dishData) {
                    Dish::create([
                        'name' => $dishData['name'],
                        'description' => $dishData['description'],
                        'price' => $dishData['price'],
                        'image' => filter_var($dishData['image'], FILTER_VALIDATE_URL)
                            ? $dishData['image']
                            : asset('storage/' . $dishData['image']),
                        'visibility' => $dishData['visibility'],
                        'restaurant_id' => $restaurant->id,
                        'category_id' => $category->id, // Associa alla categoria corretta
                    ]);
                }
            }
        }
    }
}
