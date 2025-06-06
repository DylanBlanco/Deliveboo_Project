<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['dishes', 'categories'])->get()->map(function ($restaurant) {
            $restaurant->image = filter_var($restaurant->image, FILTER_VALIDATE_URL)
                ? $restaurant->image
                : asset('storage/' . $restaurant->image);

            $restaurant->dishes = $restaurant->dishes->map(function ($dish) {
                $dish->image = filter_var($dish->image, FILTER_VALIDATE_URL)
                    ? $dish->image
                    : asset('storage/' . $dish->image);
                return $dish;
            });

            return $restaurant;
        });

        return response()->json($restaurants);
    }

    public function show($id)
    {
        $restaurant = Restaurant::with('dishes')->find($id);

        if (!$restaurant) {
            return response()->json(['error' => 'Ristorante non trovato'], 404);
        }

        $restaurant->image = filter_var($restaurant->image, FILTER_VALIDATE_URL)
            ? $restaurant->image
            : asset('storage/' . $restaurant->image);

        $restaurant->dishes = $restaurant->dishes->map(function ($dish) {
            $dish->image = filter_var($dish->image, FILTER_VALIDATE_URL)
                ? $dish->image
                : asset('storage/' . $dish->image);
            return $dish;
        });

        return response()->json($restaurant);
    }
}
