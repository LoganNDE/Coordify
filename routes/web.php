<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\UsuarioController;
use App\Http\Resources\Categories;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\QRCodeController;


Route::get('events/view/{id}', [EventController::class, 'publicShow'])->name('events.showPublic');
Route::get('events/newadmin', AdministratorController::class)->name('events.newadmin');
Route::post('events/newadmin', [AdministratorController::class, 'newadmin'])->name('events.newadmin');
Route::get('events/archive/{id}', [EventController::class, 'archive'])->name('events.archive');
Route::get('events/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');
Route::get('reader', [EventController::class, 'showReader'])->name('events.qrReader');
Route::get('settings', [UsuarioController::class ,'showSettings'])->name('events.settings');
Route::get('administration', [EventController::class, 'index'] )->name('events.index');
Route::get('events', [EventController::class, 'index']);
Route::resource('events', EventController::class)->except('index', 'destroy');
Route::get('login', UsuarioController::class)->name('login');
Route::get('logout', [UsuarioController::class, 'logout'])->name('logout');
Route::post('login', [UsuarioController::class, 'login'])->name('checkLogin');
Route::post('event/import', [EventController::class, 'importEvent']);

// FrontController
Route::get('/', FrontController::class )->name('front.index');
Route::get('/subscriptions', [FrontController::class, 'getViewSubscription'])->name('front.subscriptions');

//Usuarios
Route::post('settings', [UsuarioController::class, 'updateDetails'])->name('user.updateDetails');
Route::post('settings/password', [UsuarioController::class, 'updatePassword'])->name('user.updatePassword');

// Checkout
Route::get('events/checkout/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/checkout/success', [paymentController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout/cancel/{id}', [paymentController::class, 'cancelCheckout'])->name('checkout.cancel');

// Subscriptions
Route::post('/subscriptions', [paymentController::class, 'checkoutSubscription'])->name('subscription.checkout');
Route::get('/subscriptions/success', [paymentController::class, 'subscriptionSuccess'])->name('subscription.success');
Route::get('/subscription/error', [paymentController::class, 'errorSubscription'])->name('subscription.error');
Route::get('/subscription/cancel', [paymentController::class, 'cancelSubscription'])->name('subscription.cancel');




// Categorias
Route::get('data/api/getcategories', function () {
    return CategoriesResource::collection(Category::all());
});

// QR Generation
Route::get('/generate-qr', [QRCodeController::class, 'generate']);

// QR Validation
Route::post('reader', [QRCodeController::class, 'QRValidate']);
