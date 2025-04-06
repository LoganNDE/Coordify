<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\UsuarioController;
use App\Http\Resources\Categories;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('events/view/{id}', [EventController::class, 'publicShow'])->name('events.showPublic');
Route::get('events/newadmin', AdministratorController::class)->name('events.newadmin');
Route::post('events/newadmin', [AdministratorController::class, 'newadmin'])->name('events.newadmin');
Route::get('events/archive/{id}', [EventController::class, 'archive'])->name('events.archive');
Route::get('events/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');
Route::get('settings', [UsuarioController::class ,'showSettings'])->name('events.settings');
Route::get('/', [EventController::class, 'getPublicEvents'] )->name('events.public');
Route::get('administration', [EventController::class, 'index'] )->name('events.index');
Route::get('events', [EventController::class, 'index']);
Route::resource('events', EventController::class)->except('index', 'destroy');
Route::get('login', UsuarioController::class)->name('login');
Route::get('logout', [UsuarioController::class, 'logout'])->name('logout');
Route::post('login', [UsuarioController::class, 'login'])->name('checkLogin');
Route::post('event/import', [EventController::class, 'importEvent']);

//Usuarios

Route::post('settings', [UsuarioController::class, 'updateDetails'])->name('user.updateDetails');
Route::post('settings/password', [UsuarioController::class, 'updatePassword'])->name('user.updatePassword');


// Checkout

Route::get('events/checkout/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');

Route::get('/checkout/success', function () {
    return 'Pago realizado con éxito.';
})->name('checkout.success');

Route::get('/checkout/cancel', function () {
    return 'Pago cancelado.';
})->name('checkout.cancel');


Route::get('data/api/getcategories', function () {
    return CategoriesResource::collection(Category::all());
});