<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostumersController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Ecommerce\FrontController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\OrderController as EcommerceOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
// use App\Models\OrderDetail;

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

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/produk', [FrontController::class, 'product'])->name('front.product');
Route::get('/category/{slug}', [FrontController::class,'categoryProduct'])->name('front.category');
Route::get('/product/{slug}', [FrontController::class, 'show'])->name('front.show_product');
Route::get('/contact', function () {
    return view('costumer.contact');
});

Route::get('/coba', function () {
    return view('costumer.cart');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function () {

    /* route product */
    Route::get('auth/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('create/product', [ProductController::class, 'create'])->name('product.create');
    Route::post('create/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/{product_id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/{product_id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('product/bulk', [ProductController::class, 'massUploadForm'])->name('product.bulk');
    Route::post('product/bulk', [ProductController::class, 'massUpload'])->name('product.saveBulk');
    // Route::get('/product/search', [ProductController::class, 'search']);
    // Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');


    /* route kategori */
    Route::get('kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::post('kategori', [CategoryController::class, 'store'])->name('category.store');
    Route::get('kategori/{category_id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('kategori/{category_id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('kategori/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    /* order */
    Route::get('order', [OrderController::class, 'viewOrder'])->name('report.order');
    Route::get('order/pdf/{daterange}', [OrderController::class, 'orderReportPdf'])->name('report.order_pdf');
    
    // Laporan pdf
    // Route::get('/riwayat', [RiwayatController::class, 'index'])->name('laporan.view');
    // // Route::get('/riwayat/cetak_laporan', [RiwayatController::class, 'exportPdf'])->name('laporan.cetak_laporan');


    
    // Route::get('create/order', [OrderController::class, 'create'])->name('order.create');

    // Pesanan
    Route::get('pesanan/index', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('create/pesanan', [PesananController::class, 'create'])->name('pesanan.create');
    // Route::post('create/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
});


/* costumer login & register */
Route::prefix('/costumer')->name('costumer.')->namespace('Costumer')->group(function(){
    Route::get('/login', [CostumersController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CostumersController::class, 'login'])->name('login.post');
    Route::post('/logout', [CostumersController::class, 'logout'])->name('logout');
});

