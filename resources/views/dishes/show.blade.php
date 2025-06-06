@extends('layouts.app')

@section('page-title', 'Singolo Piatto')

@section('main-content')

<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mb-3" style="max-width: 540px;">

                    {{-- Visualizzazione del piatto --}}
                    @if (filter_var($dish->image, FILTER_VALIDATE_URL))
                        <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}">
                        @elseif ($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top" alt="{{ $dish->name }}">
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Immagine non disponibile">
                    @endif
                    
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $dish->name }}
                                </h5>
                                <p class="card-text">
                                    <small class="text-body-secondary">
                                        {{ $dish->description }}
                                    </small>
                                </p>
                                <h6 class="card-title">
                                    € {{ $dish->price }}
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('dishes.edit', ['dish' => $dish->id]) }}" class="button-menu text-decoration-none ibm-plex-mono-regular me-2 mb-2">
                                Modifica
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('dishes.index') }}" class="button-menu text-decoration-none ibm-plex-mono-regular my-1">Torna al menu</a>
            </div>
        </div>
    </div>
</section>
    
@endsection

<style>
    section{
        background-image: url('{{ asset('/images/background-dish.jpg') }}');
        background-size: cover;
    }
</style>
