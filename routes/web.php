<?php

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

/*Trang nguoi dung*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Routes Trong Trang admin*/
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

//  Categories Routes
    Route::get('categories', [App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('categories');
    Route::get('add-categories', [App\Http\Controllers\Admin\CategoriesController::class, 'create']);
    Route::post('add-categories', [App\Http\Controllers\Admin\CategoriesController::class, 'store']);
    Route::get('edit-categories/{category_id}', [App\Http\Controllers\Admin\CategoriesController::class, 'edit']);
    Route::put('update-categories/{category_id}', [App\Http\Controllers\Admin\CategoriesController::class, 'update']);
    Route::get('delete-categories/{category_id}', [App\Http\Controllers\Admin\CategoriesController::class, 'delete']);

//  Publishers Routes
    Route::get('publishers', [App\Http\Controllers\Admin\PublisherController::class, 'index'])->name('publishers');
    Route::get('add-publishers', [App\Http\Controllers\Admin\PublisherController::class, 'create']);
    Route::post('add-publishers', [App\Http\Controllers\Admin\PublisherController::class, 'store']);
    Route::get('edit-publishers/{publishers_id}', [App\Http\Controllers\Admin\PublisherController::class, 'edit']);
    Route::put('update-publishers/{publishers_id}', [App\Http\Controllers\Admin\PublisherController::class, 'update']);
    Route::get('delete-publishers/{publishers_id}', [App\Http\Controllers\Admin\PublisherController::class, 'delete']);

//  Authors Routes
    Route::get('authors', [App\Http\Controllers\Admin\AuthorController::class, 'index'])->name('authors');
    Route::get('add-authors', [App\Http\Controllers\Admin\AuthorController::class, 'create']);
    Route::post('add-authors', [App\Http\Controllers\Admin\AuthorController::class, 'store']);
    Route::get('edit-authors/{authors_id}', [App\Http\Controllers\Admin\AuthorController::class, 'edit'])->name('author-edit');
    Route::put('update-authors/{authors_id}', [App\Http\Controllers\Admin\AuthorController::class, 'update']);
    Route::get('delete-authors/{authors_id}', [App\Http\Controllers\Admin\AuthorController::class, 'delete']);

//  Books Routes
    Route::get('books', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('Books');
    Route::get('add-books', [App\Http\Controllers\Admin\BookController::class, 'create']);
    Route::post('add-books', [App\Http\Controllers\Admin\BookController::class, 'store']);
    Route::get('edit-books/{books_id}', [App\Http\Controllers\Admin\BookController::class, 'edit'])->name('Books-edit');
    Route::put('update-books/{books_id}', [App\Http\Controllers\Admin\BookController::class, 'update']);
    Route::get('delete-books/{books_id}', [App\Http\Controllers\Admin\BookController::class, 'delete']);

//  Employee Routes
    Route::get('employees', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('employees');
    Route::get('add-employees', [App\Http\Controllers\Admin\EmployeeController::class, 'create']);
    Route::post('add-employees', [App\Http\Controllers\Admin\EmployeeController::class, 'store']);
    Route::get('edit-employees/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'edit']);
    Route::put('edit-employees/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update']);
    Route::get('delete-employees/{employee_id}', [App\Http\Controllers\Admin\EmployeeController::class, 'delete']);

//  Customer Routes
    Route::get('customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers');
    Route::get('edit-customers/{customers}', [App\Http\Controllers\Admin\CustomerController::class, 'edit']);

//  Discounts Routes
    Route::get('discounts', [App\Http\Controllers\Admin\DiscountController::class, 'index'])->name('discounts');
    Route::post('add-discounts', [App\Http\Controllers\Admin\DiscountController::class, 'store']);
    Route::put('update-discounts/{discounts_id}', [App\Http\Controllers\Admin\DiscountController::class, 'update']);
    Route::get('delete-discounts/{discounts_id}', [App\Http\Controllers\Admin\DiscountController::class, 'delete']);

//  Orders Routes
    Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders');
    Route::get('add-orders', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('addOrder');
    Route::post('store-orders', [App\Http\Controllers\Admin\OrderController::class, 'store']);

    Route::get('edit-orders/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'edit']);
    Route::put('edit-orders/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'update']);
    Route::get('delete-orders/{order_id}', [App\Http\Controllers\Admin\OrderController::class, 'delete']);

//  OrderDetails Routes
    Route::post('update-order-detail', [App\Http\Controllers\Admin\OrderController::class, 'updateOrderDetail']);
    Route::get('update-order-detail', [App\Http\Controllers\Admin\OrderController::class, 'updateOrderDetail']);

//  paymentMethods Routes
    Route::get('paymentmethods', [App\Http\Controllers\Admin\PaymentMethodController::class, 'index'])->name('paymentmethods');
    Route::post('add-paymentmethods', [App\Http\Controllers\Admin\PaymentMethodController::class, 'store']);
    Route::put('update-paymentmethods/{paymentmethod_id}', [App\Http\Controllers\Admin\PaymentMethodController::class, 'update']);
    Route::get('delete-paymentmethods/{paymentmethod_id}', [App\Http\Controllers\Admin\PaymentMethodController::class, 'delete']);
});

