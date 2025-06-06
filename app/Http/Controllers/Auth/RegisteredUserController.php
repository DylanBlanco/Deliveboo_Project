<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    // funzione di riacquisizione account da SoftDelete
    public function create(array $input)
    {
        // check di utenti cancellati con soft delete
        $user = User::onlyTrashed()->where('email', $input['email'])->first();

        // Ripristina utente
        if ($user) {
            // Recupero utente
            $user->restore();

            // Agiorna dati se utente si registra con valori diversi
            $user->update([
                'username' => $input['username'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'restaurant_name' => $input['restaurant_name'],
                'address' => $input['address'],
                'partita_iva' => $input['partita_iva'],
                'cuisine_type' => $input['cuisine_type'],
                'image' => $input['image'],
            ]);
            return $user;
        }
    }

    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view('auth.register', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'restaurant_name' => 'required|string',
            'address' => 'required|string',
            'partita_iva' => 'required|digits:11|unique:restaurants,partita_iva',
            'cuisine_type' => 'required|array',
            'cuisine_type.*' => 'integer|exists:categories,id', // Associa le categorie al ristorante
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Verifica se l'email esiste già
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()
                ->withInput($request->except('password'))
                ->withErrors(['email' => 'Questo indirizzo email è già registrato.']);
        }

        // Crea l'utente
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Gestione dell'immagine del ristorante (se presente)
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('restaurants', 'public')
            : null;

        // Crea il ristorante associato all'utente
        $restaurant = Restaurant::create([
            'name' => $request->restaurant_name,
            'address' => $request->address,
            'partita_iva' => $request->partita_iva,
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        // Associa la categoria selezionata al ristorante
        $restaurant->categories()->sync($request->cuisine_type); // Solo le categorie, nessun piatto associato

        // Non popolare piatti, lascia che l'utente aggiunga piatti separatamente

        // Login dell'utente appena creato
        Auth::login($user);

        // Redirigi alla dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Registrazione completata con successo!');
    }
}
