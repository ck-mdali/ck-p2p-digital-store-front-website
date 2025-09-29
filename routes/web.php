<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\P2pController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FreelancerController;

Route::get('/', [PageController::class, 'home'])->name('page.home');

// 404 route
Route::get('/404', function(){
    return view('404');
})->name('404');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/p2p/orders', [P2pController::class, 'index'])->name('p2p.index');
    Route::post('/p2p/order/new/{product_id}', [P2pController::class, 'orderCreate'])->name('p2p.order.new');
    Route::get('/p2p/order/details/{id}', [P2pController::class, 'order'])->name('p2p.order');
    Route::post('/p2p/order/update/status/paid', [P2pController::class, 'orderUpdatePaid'])->name('p2p.order.update.paid');
    
    // Fetch chat messages for a specific order
    Route::get('/p2p/chat/{order_id}', [ChatMessageController::class, 'fetchMessages'])->name('p2p.chat.fetch');
    
    // Send a new message
    Route::post('/p2p/chat/send', [ChatMessageController::class, 'send'])->middleware('auth');
    Route::get('orders/export/excel', [P2pController::class, 'exportOrdersExcel'])->name('p2p.exportOrdersExcel');
    Route::get('orders/export/pdf', [P2pController::class, 'exportOrdersPDF'])->name('p2p.exportOrdersPDF');
    Route::get('orders/print', [P2pController::class, 'printOrders'])->name('p2p.printOrders');

    // Route to create a transaction (for when an order is marked as paid)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transaction/order/{order}', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('/transaction/{transaction}/verify', [TransactionController::class, 'verify'])->name('transactions.verify');

    Route::get('/my-downloads', [DownloadsController::class, 'index'])->name('downloads.index');
    Route::get('/downloads/{order_id}/download', [DownloadsController::class, 'download'])->name('downloads.download');

    Route::post('/products/{product}/comments', [CommentController::class, 'store'])->name('comments.store');

    // admin console
    Route::get('/admin/console', [P2pController::class, 'adminConsole'])->name('admin.console');
    Route::post('/admin/console/mark', [P2pController::class, 'adminMarkOrder'])->name('admin.console.mark');
    Route::get('/admin/console/check-pool', [P2pController::class, 'checkNew'])->name('admin.console.check.pool');
});

Route::get('/p2p/checkout/{id}', [P2pController::class, 'checkout'])->name('p2p.view');
Route::get('/products', [ProductController::class, 'archive'])->name('product.list');
Route::get('/products/{category}', [ProductController::class, 'archiveCategory'])->name('product.list.category');
Route::get('/products/{category}/{slug}', [ProductController::class, 'show'])->name('product.view');

Route::get('/freelancers', [FreelancerController::class, 'index'])->name('freelancers.index');
Route::get('/freelancers/{freelancer}', [FreelancerController::class, 'show'])->name('freelancers.show');

require __DIR__.'/auth.php';

// Page
Route::get('/{slug}', [PageController::class, 'dynamicPage'])->name('page.view');