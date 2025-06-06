<?php

// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\Admin\AdminRestaurantController;
use App\Models\Order;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');

    });

// Rotte protette da autenticazione
Route::middleware('auth')->group(function () {
    Route::resource('dishes', DishController::class);
});

// Rotta per user.profile 
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::delete('/user/id', [UserController::class, 'destroy'])->name('user.destroy');

// Rotta per il form di registrazione
Route::get('/register-restaurant', [RegisteredUserController::class, 'showRegistrationForm'])->name('restaurant.register');

// Rotta per la creazione dell'utente
Route::post('/register-restaurant', [RegisteredUserController::class, 'store'])->name('restaurant.store');

// Rotta per il ripristino del piatto
// Route::post('/dishes/id/restore', [DishController::class, 'restore'])->name('dishes.restore');
Route::post('/dishes/{id}/restore', [DishController::class, 'restore'])->name('dishes.restore');

// Rotta per eliminare definivamente piatto
Route::delete('/dishes/{id}/force-delete', [DishController::class, 'forceDestroy'])->name('dishes.forceDestroy');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Rotta per visualizzare gli ordini di un ristorante
    Route::get('/restaurant/{restaurant}/orders', [AdminRestaurantController::class, 'showOrders'])->name('restaurant.orders');
    Route::get('/orders/{order}', [AdminRestaurantController::class, 'showOrder'])->name('orders.show');
});

Route::get('/restaurant/{restaurant}/statistics', [AdminRestaurantController::class, 'showStatistics'])->name('admin.restaurant.statistics');



require __DIR__ . '/auth.php';
