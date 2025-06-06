<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminRestaurantController extends Controller
{
    // Metodo per visualizzare gli ordini di un ristorante
    public function showOrders(Restaurant $restaurant)
    {
        $orders = $restaurant->orders()->orderBy('created_at', 'desc')->get();
        // Modifica il percorso della vista per puntare a 'orders/orders.blade.php'
        return view('orders.orders', compact('restaurant', 'orders'));
    }
    public function showOrder(Order $order)
    {
        // Carica l'ordine con i piatti associati, incluse le informazioni nella tabella pivot
        $order->load('dishes');

        // Restituisci la vista con i dettagli dell'ordine
        return view('orders.show', compact('order'));
    }
    public function showStatistics(Restaurant $restaurant)
    {
        // Recupera il numero di ordini per mese
        $ordersPerMonth = Order::where('restaurant_id', $restaurant->id)
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as orders_count'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        // Recupera l'ammontare delle vendite per mese
        $salesPerMonth = Order::where('restaurant_id', $restaurant->id)
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as sales_total'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        // Recupera il numero di volte che ogni piatto è stato ordinato
        $dishesOrderCount = DB::table('ordered_request')
            ->join('dishes', 'ordered_request.dish_id', '=', 'dishes.id')
            ->select('dishes.name', DB::raw('SUM(ordered_request.quantity) as total_orders'))
            ->where('dishes.restaurant_id', $restaurant->id)
            ->groupBy('dishes.id')
            ->orderByDesc('total_orders')
            ->get();

        return view('orders.statistics', compact('restaurant', 'ordersPerMonth', 'salesPerMonth', 'dishesOrderCount'));
    }
}

