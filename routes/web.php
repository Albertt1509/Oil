<?php

use App\Livewire\AboutPage;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyorderDetailPage;
use App\Livewire\MyorderPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

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
    Route::get('/',HomePage::class);
    Route::get('/about',AboutPage::class);
    Route::get('/products',ProductPage::class);
    Route::get('/products/{slug}',ProductDetailPage::class);
    Route::get('/cart',CartPage::class);

    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/my-orders', MyorderPage::class)->name('my-orders');
    Route::get('/my-orders/{order_id}', MyorderDetailPage::class)->name('my-order-detail');
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
    Route::get('logout', function(){
        auth()->logout();
        return redirect('/');
    })->name('logout');
});