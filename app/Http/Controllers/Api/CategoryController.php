<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Restituisce tutte le categorie.
     */
    public function index()
    {
        // Recupera tutte le categorie
        $categories = Category::all();

        // Ritorna le categorie in formato JSON
        return response()->json($categories);
    }
}
