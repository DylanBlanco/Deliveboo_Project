<!-- resources/views/admin/restaurants/orders.blade.php -->

@extends('layouts.app') <!-- Usa il layout principale -->

@section('page-title', 'Ordini - ' . $restaurant->name)

@section('main-content')
    <div class="container mt-5 pt-5">
        <h1 class="text-center ibm-plex-mono-bold mb-4">Ordini del ristorante: {{ $restaurant->name }}</h1>

        <!-- Table styling -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark ibm-plex-mono-semibold">
                    <tr>
                        <th scope="col">Ordine ID</th>
                        <th scope="col">Data Ordine</th>
                        <th scope="col">Nome Cliente</th>
                        <th scope="col">Telefono Cliente</th>
                        <th scope="col">Email Cliente</th>
                        <th scope="col">Totale</th>
                        <th scope="col">Dettagli</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->telephone }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->total_price }} €</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="btn btn-info btn-sm">Dettagli</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Optional, if no orders -->
        @if ($orders->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                Nessun ordine trovato per questo ristorante.
            </div>
        @endif
    </div>
@endsection
