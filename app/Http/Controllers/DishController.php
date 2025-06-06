<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\{
    Category,
    Dish
};

class DishController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;

        if (!$restaurant) {
            Log::error('Index Dish: Nessun ristorante associato all\'utente');
            return redirect()->route('home')->with('error', 'Non hai un ristorante associato.');
        }

        $filter = $request->filter;
        $query = Dish::query()->where('restaurant_id', $restaurant->id);

        if ($filter === 'trashed') {
            $dishes = $query->onlyTrashed()->get();
        } elseif ($filter === 'all') {
            $dishes = $query->withTrashed()->get();
        } else {
            $dishes = $query->get();
        }

        $trashedCount = $query->onlyTrashed()->count();
        $activeCount = $query->count();
        $allCount = $query->withTrashed()->count();

        return view('dishes.index', compact('dishes', 'restaurant', 'trashedCount', 'activeCount', 'allCount'));
    }

    public function create()
    {
        $categories = Category::all();

        Log::info('Create Dish: Inizializzazione della vista create', [
            'categories_count' => $categories->count()
        ]);

        return view('dishes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        Log::info('Store Dish: dati ricevuti', $validatedData);

        $restaurant = auth()->user()->restaurant;

        if (!$restaurant) {
            Log::error('Store Dish: Nessun ristorante associato all\'utente');
            return redirect()->route('home')->with('error', 'Non hai un ristorante associato.');
        }

        $imagePath = $request->file('image')
            ? $request->file('image')->store('dishes', 'public')
            : null;

        Log::info('Store Dish: percorso immagine', ['imagePath' => $imagePath]);

        $dish = Dish::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $imagePath ? asset('storage/' . $imagePath) : null,
            'visibility' => $request->has('visibility'),
            'category_id' => $validatedData['category_id'],
            'restaurant_id' => $restaurant->id,
        ]);

        Log::info('Store Dish: piatto creato', $dish->toArray());

        return redirect()->route('dishes.index')->with('success', 'Piatto creato con successo!');
    }

    public function show(Dish $dish)
    {
        Log::info('Show Dish: Visualizzazione del piatto', ['dish_id' => $dish->id]);
        return view('dishes.show', compact('dish'));
    }

    public function edit(Dish $dish)
    {
        $categories = Category::all();

        Log::info('Edit Dish: Inizializzazione della vista edit', [
            'dish_id' => $dish->id,
            'categories_count' => $categories->count()
        ]);

        return view('dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, Dish $dish)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        Log::info('Update Dish: dati ricevuti', $validatedData);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dishes', 'public');
            $dish->image = asset('storage/' . $imagePath);

            Log::info('Update Dish: percorso immagine aggiornato', ['imagePath' => $imagePath]);
        }

        $dish->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'visibility' => $request->has('visibility'),
            'category_id' => $validatedData['category_id'],
        ]);

        Log::info('Update Dish: piatto aggiornato', $dish->toArray());

        return redirect()->route('dishes.show', ['dish' => $dish->id])->with('success', 'Piatto aggiornato con successo!');
    }

    public function destroy(Dish $dish)
    {
        Log::info('Destroy Dish: eliminazione del piatto', ['dish_id' => $dish->id]);
        $dish->delete();

        return redirect()->route('dishes.index')->with('success', 'Piatto eliminato con successo!');
    }

    public function restore($id)
    {
        $dish = Dish::onlyTrashed()->findOrFail($id);
        $dish->restore();

        Log::info('Restore Dish: piatto ripristinato', ['dish_id' => $dish->id]);

        return redirect()->route('dishes.index')->with('success', 'Piatto ripristinato con successo!');
    }

    public function forceDestroy($id)
    {
        $dish = Dish::onlyTrashed()->findOrFail($id);
        $dish->forceDelete();

        Log::info('Force Destroy Dish: piatto eliminato definitivamente', ['dish_id' => $dish->id]);

        return redirect()->route('dishes.index')->with('success', 'Piatto eliminato definitivamente!');
    }
}
