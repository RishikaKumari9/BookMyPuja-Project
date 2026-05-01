<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\BrazorpayController;

Route::get('/', function () {
    return view('welcome');
});

//--------------------------------------------------------------------------------------------------------------------------
//Auth Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/home', [AuthController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile/edit', [AuthController::class, 'showEditProfileForm'])->name('edit.profile');
Route::post('/profile/edit', [AuthController::class, 'updateProfile'])->name('edit.profile.post');
Route::get('/profile/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/profile/change-password', [AuthController::class, 'changePassword'])->name('password.change.post');
Route::get('/aboutUs', [AuthController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contactUs', [AuthController::class, 'contactUs'])->name('contactUs');


//--------------------------------------------------------------------------------------------------------------------------
//Admin Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/admin/login', [AdminController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login.post');
//Route::get('/admin', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard')->middleware('auth:admin');
Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin/register', [AdminController::class, 'showAdminRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register.post');
// Route::get('/admin/profile', [AdminController::class, 'showAdminProfile'])->name('admin.profile')->middleware('auth:admin');
// Route::get('/admin/profile/edit', [AdminController::class, 'showEditAdminProfileForm'])->name('admin.edit.profile');


// ----------------------------------------------------------------------------------------------------------------------


Route::get('/admin', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard')->middleware('auth:admin');;
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
Route::get('/admin/users/{id}/edit', [AdminController::class, 'showEditUserForm'])->name('admin.users.edit');
Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::get('/admin/adduser', [AdminController::class, 'addUser'])->name('admin.adduser');
Route::post('/admin/adduser', [AdminController::class, 'postUser'])->name('admin.adduser.post');
Route::delete('/admin/users/destroy/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

Route::get('/admin/products', [AdminController::class, 'showAdminProducts'])->name('admin.products');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
Route::post('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/admin/products/destroy/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
Route::get('/admin/addproduct', [AdminController::class, 'addProduct'])->name('admin.addproduct');
Route::post('/admin/addproduct', [AdminController::class, 'postProduct'])->name('admin.addproduct.post');

//--------------------------------------------------------------------------------------------------------------------------
//Auth Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/products', [AuthController::class, 'showProducts'])->name('products');
Route::post('cart/add/{id}', [AuthController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [AuthController::class, 'viewCart'])->name('cart.view');
Route::post('cart/remove/{id}', [AuthController::class, 'removeFromCart'])->name('cart.remove');
// Route::post('cart/update/{id}', [AuthController::class, 'updateCart'])->name('cart.update');
Route::post('checkout/process', [AuthController::class, 'processCheckout'])->name('checkout.process');
Route::post('/cart/update/{rowId}', [AuthController::class, 'updateCart'])->name('cart.update');

//--------------------------------------------------------------------------------------------------------------------------
//Admin Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/admin/pujas', [AdminController::class, 'showAdminPujas'])->name('admin.pujas');
Route::get('/admin/pujas/{id}/edit', [AdminController::class, 'editPuja'])->name('admin.pujas.edit');
Route::post('/admin/pujas/update/{id}', [AdminController::class, 'updatePuja'])->name('admin.pujas.update');
Route::delete('/admin/pujas/destroy/{id}', [AdminController::class, 'destroyPuja'])->name('admin.pujas.destroy');
Route::get('/admin/addpuja', [AdminController::class, 'addPuja'])->name('admin.addpuja');
Route::post('/admin/addpuja', [AdminController::class, 'postPuja'])->name('admin.addpuja.post');

//--------------------------------------------------------------------------------------------------------------------------
//Auth Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/pujas', [AuthController::class, 'showPujas'])->name('pujas');
Route::post('booking/add/{id}', [AuthController::class, 'addToBooking'])->name('booking.add');
Route::get('/booking', [AuthController::class, 'viewBooking'])->name('booking.view');
Route::post('booking/remove/{id}', [AuthController::class, 'removeFromBooking'])->name('booking.remove');
// Route::post('booking/update/{id}', [AuthController::class, 'updateBooking'])->name('booking.update');
Route::post('booking/process', [AuthController::class, 'processBooking'])->name('booking.process');
Route::post('/booking/update/{rowId}', [AuthController::class, 'updateBooking'])->name('booking.update');
//Route::post('booking/update-address', [AuthController::class, 'updateAddress'])->name('booking.updateAddress');

Route::post('booking/selectpriest', [AuthController::class, 'selectPriest'])->name('booking.selectPriest');

//--------------------------------------------------------------------------------------------------------------------------
//Admin Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/admin/priests', [AdminController::class, 'showAdminPriests'])->name('admin.priests');
Route::get('/admin/priests/{id}/edit', [AdminController::class, 'editPriest'])->name('admin.priests.edit');
Route::post('/admin/priests/update/{id}', [AdminController::class, 'updatePriest'])->name('admin.priests.update');
Route::delete('/admin/priests/destroy/{id}', [AdminController::class, 'destroyPriest'])->name('admin.priests.destroy');
Route::get('/admin/addpriest', [AdminController::class, 'addPriest'])->name('admin.addpriest');
Route::post('/admin/addpriest', [AdminController::class, 'postPriest'])->name('admin.addpriest.post');

//--------------------------------------------------------------------------------------------------------------------------
//Auth Routes
//--------------------------------------------------------------------------------------------------------------------------

Route::get('/priests', [AuthController::class, 'showPriests'])->name('priests');

Route::get('/my-orders', [AuthController::class, 'showMyOrders'])->name('my.orders');
Route::get('/orders/{id}', [AuthController::class, 'viewOrderDetail'])->name('orders.show');



Route::get('/pay', [RazorpayController::class, 'pay']);
Route::post('/payment', [RazorpayController::class, 'payment'])->name('payment');


Route::get('/bpay', [BrazorpayController::class, 'bpay']);
Route::post('/bpayment', [BrazorpayController::class, 'bpayment'])->name('bpayment');


Route::get('/my-bookings', [AuthController::class, 'showMyBookings'])->name('my.bookings');
Route::get('/bookings/{id}', [AuthController::class, 'viewBookingDetail'])->name('bookings.show');
