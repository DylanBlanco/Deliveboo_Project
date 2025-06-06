@extends('layouts.app')

@section('page-title', 'Dettagli Ordine #' . $order->id)

@section('main-content')
    <div class="container mt-5 pt-5">
        <h1 class="text-center mb-4">Dettagli Ordine #{{ $order->id }}</h1>

        <div class="row">
            <div class="col-md-6">
                <h4>Informazioni Cliente</h4>
                <p><strong>Nome:</strong> {{ $order->name }}</p>
                <p><strong>Telefono:</strong> {{ $order->telephone }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
            </div>

            <div class="col-md-6">
                <h4>Dettagli Ordine</h4>
                <p><strong>Data Ordine:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Totale Ordine:</strong> {{ $order->total_price }} €</p>
            </div>
        </div>

        <div class="mt-4">
            <h4>Piatti Ordinati</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome Piatto</th>
                        <th>Quantità</th>
                        <th>Prezzo Singolo</th>
                        <th>Totale per Piatto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->dishes as $dish)
                        <tr>
                            <td>{{ $dish->name }}</td>
                            <td>{{ $dish->pivot->quantity }}</td>
                            <td>{{ $dish->price }} €</td>
                            <td>{{ $dish->pivot->quantity * $dish->price }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
