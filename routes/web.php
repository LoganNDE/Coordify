<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\UserController;
use App\Http\Resources\Categories;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\QRCodeController;


Route::get('events/view/{id}', [EventController::class, 'publicShow'])->name('events.showPublic');
Route::get('events/newadmin', AdministratorController::class)->name('events.newadmin');
Route::post('events/newadmin', [AdministratorController::class, 'newadmin'])->name('events.newadmin');
Route::get('events/archive/{id}', [EventController::class, 'archive'])->name('events.archive');
Route::get('events/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');
Route::get('reader', [EventController::class, 'showReader'])->name('events.qrReader');


Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/archives', [EventController::class, 'archives'] )->name('events.archives');
Route::get('events/unarchive/{id}', [EventController::class, 'unarchive'])->name('events.unarchive');
Route::post('event/import', [EventController::class, 'importEvent']);
Route::resource('events', EventController::class)->except('index', 'destroy');


Route::get('login', UserController::class)->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('login', [UserController::class, 'login'])->name('checkLogin');
// BackController



// AdministratorController
Route::get('/login-admin', AdministratorController::class)->name('admin.checklogin');
Route::get('/register-admin', [AdministratorController::class, 'registerLikeUser'])->name('admin.register');
Route::post('/login-admin', [AdministratorController::class, 'login'])->name('admin.checkLogin');


// Ruta repetida se debe de modificar el view en el que se usa para identificar
Route::get('logout-admin', [AdministratorController::class, 'logout'])->name('admin.logout');
Route::get('settings-admin', [AdministratorController::class ,'showSettings'])->name('admin.settings');
Route::post('settings-admin', [AdministratorController::class, 'updateDetails'])->name('admin.updateDetails');
Route::post('settings/password-admmin', [AdministratorController::class, 'updatePassword'])->name('admin.updatePassword');





// FrontController
Route::get('/', FrontController::class )->name('front.index');
Route::get('/subscriptions', [FrontController::class, 'getViewSubscription'])->name('front.subscriptions');
Route::get('/tickets', [FrontController::class, 'getViewTickets'])->name('front.tickets');
Route::get('/legal-notice', [FrontController::class, 'getLegalNotice'])->name('front.legal-notice');
Route::get('/privacy-policy', [FrontController::class, 'getPrivacyPolicy'])->name('front.privacy-policy');

//Usuarios
Route::post('settings', [UserController::class, 'updateDetails'])->name('user.updateDetails');
Route::get('settings', [UserController::class ,'showSettings'])->name('user.settings');
Route::post('settings/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::get('register', [UserController::class, 'showRegister'])->name('userShow.register');
Route::post('register', [UserController::class, 'register'])->name('user.register');

Route::get('events/newadmin', [UserController::class, 'showNewAdmin'])->name('events.newadmin');
Route::post('events/newadmin', [UserController::class, 'newadmin'])->name('events.newadmin');

// Checkout
Route::get('events/checkout/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/checkout/success', [paymentController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout/cancel/{id}', [paymentController::class, 'cancelCheckout'])->name('checkout.cancel');

// Subscriptions
Route::post('/subscriptions', [paymentController::class, 'checkoutSubscription'])->name('subscription.checkout');
Route::get('/subscriptions/success', [paymentController::class, 'subscriptionSuccess'])->name('subscription.success');
Route::get('/subscription/error', [paymentController::class, 'errorSubscription'])->name('subscription.error');
Route::get('/subscription/cancel', [paymentController::class, 'cancelSubscription'])->name('subscription.cancel');




// API Categorias
Route::get('data/api/getcategories', function () {
    return CategoriesResource::collection(Category::all());
});

// QR Generation
Route::get('/generate-qr', [QRCodeController::class, 'generate']);

// QR Validation
Route::post('reader', [QRCodeController::class, 'QRValidate']);

Route::get('/test-mail', function () {
    Mail::raw('Este es un correo de prueba desde mi servidor SMTP.', function ($message) {
        $message->to('mnoguerabe@gmail.com')
                ->subject('Correo de prueba desde Laravel');
    });

    return 'Correo enviado';
});