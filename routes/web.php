<?php

use Illuminate\Support\Facades\Route;
use App\Models\orders;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';







/////////////////////////////////  API ROUTES /////////////////////////////////



Route::get('/api/orders', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return orders::all();
});


Route::get('api/orders/{id}', function($id) {
    return orders::find($id);
});

Route::post('api/orders/create', function(Request $request) {
    return orders::create($request->all);
});


Route::put('api/orders/{id}', function(Request $request, $id) {
    $order = orders::findOrFail($id);
    $order->update($request->all());

    return $order;
});

Route::delete('api/orders/{id}/delete', function($id) {
    orders::find($id)->delete();

    return 204;
});
