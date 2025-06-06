@extends('layouts.app')

@section('page-title', 'Profilo')

@section('main-content')
    <div class="container vh-100 py-5 text-center">
        <div class="row justify-content-center">
            <h1>Nome Utente:
                {{ Auth::user()->username }}
            </h1>
            <div class="card  border-dark mb-3  text-start my-4" style="max-width: 25rem; height: 100%;">
                <div class="card-header text-center">
                    {{ Auth::user()->username }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Dettagli profilo</h5>
                    <p class="card-text">
                        <b>
                            Username:
                        </b>
                        {{ Auth::user()->username }}
                    </p>
                    <p class="card-text">
                        <b>
                            Email:
                        </b>
                        {{ Auth::user()->email }}
                    </p>
                    {{-- <p class="card-text">
                        <b>
                            Utente verificato il:
                        </b>
                        {{ Auth::user()->email_verified_at ? 'fa-sharp fa-solid facircle-check text-success' : 'fa-solid fa-circle-xmark text-text-danger' }}
                    </p> --}}
                    <p class="card-text">
                        <b>
                            Utente creato il:
                        </b>
                        {{ Auth::user()->created_at->format('d/m/Y') }}
                    </p>
                    <p class="card-text">
                        <b>
                            Utente aggiornato il:
                        </b>
                        {{ Auth::user()->updated_at->format('d/m/Y') }}
                    </p>

                    {{-- <form action="{{ route('user.destroy') }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-outline-danger">
                            Voglio cancellare i miei dati
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection