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
Route::get('/checkout',CheckoutPage::class);
Route::get('/my-orders',MyorderPage::class);
Route::get('/my-orders/{order}',MyorderDetailPage::class);

//auth
Route::get('/login',Login::class);
Route::get('/register',register::class);
Route::get('/reset',ResetPasswordPage::class);
Route::get('/forgot',ForgotPasswordPage::class);


Route::get('/success',SuccessPage::class);
Route::get('/cancel',CancelPage::class);

