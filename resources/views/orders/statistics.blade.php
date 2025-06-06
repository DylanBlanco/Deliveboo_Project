@extends('layouts.app')

@section('page-title', 'Statistiche Ordini per ' . $restaurant->name)

@section('main-content')
    <div class="container mt-5 pt-5">
        <h1 class="text-center ibm-plex-mono-bold mb-4">Statistiche Ordini per il ristorante: {{ $restaurant->name }}</h1>

        <div class="row">
            <!-- Grafico Numero Ordini per Mese (Grafico a Barre) -->
            <div class="col-md-6">
                <h4 class="ibm-plex-mono-regular">Numero Ordini per Mese</h4>
                <canvas id="ordersChart"></canvas>
            </div>

            <!-- Grafico Ammontare Vendite per Mese (Grafico a Torta) -->
            <div class="col-md-6">
                <h4 class="ibm-plex-mono-regular">Ammontare Vendite per Mese</h4>
                <canvas id="salesChart"></canvas>
            </div>

            <!-- Grafico Numero Ordini per Piatto -->
            <div class="col-md-12 mt-5">
                <h4 class="ibm-plex-mono-regular">Numero Ordini per Piatto</h4>
                <canvas id="dishesOrderChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Dati per il grafico del numero di ordini (Bar Chart)
            const ordersData = @json($ordersPerMonth);
            const months = ordersData.map(item => `${item.month}/${item.year}`);
            const ordersCount = ordersData.map(item => item.orders_count);

            // Dati per il grafico dell'ammontare delle vendite (Pie Chart)
            const salesData = @json($salesPerMonth);
            const salesTotal = salesData.map(item => item.sales_total);

            // Dati per il grafico del numero di ordini per piatto (Bar Chart)
            const dishesData = @json($dishesOrderCount);
            const dishNames = dishesData.map(item => item.name);
            const dishOrders = dishesData.map(item => item.total_orders);

            // Grafico a Barre per il numero di ordini
            const ordersChartCtx = document.getElementById('ordersChart').getContext('2d');
            new Chart(ordersChartCtx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Numero Ordini',
                        data: ordersCount,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Grafico a Torta per l'ammontare delle vendite
            const salesChartCtx = document.getElementById('salesChart').getContext('2d');
            new Chart(salesChartCtx, {
                type: 'pie',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Ammontare Vendite (€)',
                        data: salesTotal,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            // Grafico a Barre per il numero di ordini per piatto
            const dishesOrderChartCtx = document.getElementById('dishesOrderChart').getContext('2d');
            new Chart(dishesOrderChartCtx, {
                type: 'bar',
                data: {
                    labels: dishNames,
                    datasets: [{
                        label: 'Numero Ordini per Piatto',
                        data: dishOrders,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
@endsection
