<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // middleware, solo utenti loggati possono accedere
    public function __construct(){
        $this->middleware('auth');
    }

    // Vista che restituisce prifile
    public function profile(){
        return view('user.profile');
    }

    // Funzione per Soft Delete
    public function destroy(){
        // Utente autenticato
        Auth::user()->delete();

        return redirect(route('guest'))->with('userDeleted', 'Hai cancellato i tuoi dati, spriamo di rivederti presto');
    }
}
