<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RecurringInvoiceController;


use App\Http\Controllers\NewProjectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\NewClientController;
use App\Http\Controllers\CreditController;







Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::get('/recurring-invoices', [RecurringInvoiceController::class, 'index'])->name('recurring.invoices');
Route::get('/client-create', [ClientController::class, 'create'])->name('client.create');
Route::get('/client-import', [ClientController::class, 'import'])->name('client.import');
Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');
Route::get('/invoice-create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/recurring-invoice-create', [RecurringInvoiceController::class, 'create'])->name('recurring.invoice.create');

Route::get('/products-import', [ProductController::class, 'import'])->name('products.import');
Route::get('/invoices-import', [InvoiceController::class, 'import'])->name('invoices.import');
Route::get('/invoice-create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/recurring-invoice-create', [RecurringInvoiceController::class, 'create'])->name('recurring.invoice.create');
Route::get('/recurring-invoice-import', [RecurringInvoiceController::class, 'import'])->name('recurring.invoice.import');




Route::post('/client-store', [ClientController::class, 'store'])->name('client.store');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::post('/clients/import_csv', [ClientController::class, 'import_csv'])->name('clients.import_csv');






// Display all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show form to create a new product
Route::get('/product-create', [ProductController::class, 'create'])->name('products.create');

// Store a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show form to edit an existing product
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update an existing product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Show import page (optional route if you’re using it)

// Handle file import (optional)
Route::post('/products-import', [ProductController::class, 'import'])->name('products.import');




// عرض كل الفواتير
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

// عرض فورم إضافة فاتورة جديدة
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');

// حفظ فاتورة جديدة
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');

// عرض تفاصيل فاتورة واحدة
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');

// عرض فورم تعديل فاتورة
Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');

// تحديث بيانات فاتورة
Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');

// حذف فاتورة
Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');






// عرض كل الفواتير
Route::get('/recurring-invoices', [RecurringInvoiceController::class, 'index'])->name('recurring-invoices.index');

// عرض فورم إضافة فاتورة جديدة
Route::get('/recurring-invoices/create', [RecurringInvoiceController::class, 'create'])->name('recurring-invoices.create');

// حفظ فاتورة جديدة
Route::post('/recurring-invoices', [RecurringInvoiceController::class, 'store'])->name('recurring-invoices.store');

// عرض تفاصيل فاتورة واحدة
Route::get('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'show'])->name('recurring-invoices.show');

// عرض فورم تعديل فاتورة
Route::get('/recurring-invoices/{invoice}/edit', [RecurringInvoiceController::class, 'edit'])->name('recurring-invoices.edit');

// تحديث بيانات فاتورة
Route::put('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'update'])->name('recurring-invoices.update');

// حذف فاتورة
Route::delete('/recurring-invoices/{invoice}', [RecurringInvoiceController::class, 'destroy'])->name('recurring-invoices.destroy');










// -------------------- PAYMENTS --------------------

// Show import form + process import + download template
Route::prefix('payments')->group(function () {
    Route::get('/import', [PaymentController::class, 'showImportForm'])->name('payments.import.form');
    Route::post('/import', [PaymentController::class, 'import'])->name('payments.import');
    Route::get('/template', [PaymentController::class, 'downloadTemplate'])->name('payments.template');
});

// Resource routes for payments (excluding show)
Route::resource('payments', PaymentController::class)->except(['show']);


// -------------------- QUOTES --------------------

Route::prefix('quotes')->group(function () {
    Route::get('/', [QuoteController::class, 'index'])->name('quotes.index');           // List all quotes
    Route::get('/create', [QuoteController::class, 'create'])->name('quotes.create');    // Show create form
    Route::post('/store', [QuoteController::class, 'store'])->name('quotes.store');      // Store new quote

    Route::get('/import', [QuoteController::class, 'showImportForm'])->name('quotes.import.form'); // Show import form
    Route::get('/template', [QuoteController::class, 'downloadTemplate'])->name('quotes.template');

    Route::post('/import', [QuoteController::class, 'import'])->name('quotes.import');   // Process CSV import
});



// -------------------- Credits --------------------

Route::prefix('credits')->group(function () {
    Route::get('/', [CreditController::class, 'index'])->name('credits.index');           // List all credits
    Route::get('/create', [CreditController::class, 'create'])->name('credits.create');    // Show create form
    Route::post('/store', [CreditController::class, 'store'])->name('credits.store');      // Store new credit


});
// -------------------- CLIENTS --------------------

// Full resource routes for clients
Route::resource('newclients', NewClientController::class);







Route::get('/newprojects', [NewProjectController::class, 'index'])->name('newprojects.index');
Route::get('/newprojects/create', [NewProjectController::class, 'create'])->name('newprojects.create');
Route::post('/newprojects', [NewProjectController::class, 'store'])->name('newprojects.store');


