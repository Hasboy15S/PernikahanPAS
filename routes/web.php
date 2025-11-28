<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\AksesorisController;
use App\Models\Produk;


Route::get('/', function () {
    $produk = Produk::all();
    return view('index', compact('produk'));
})->name('index');
Route::post('/scan', [InvitationController::class, 'scanCode'])->name('scanCode');
Route::post('/invite-user', [InvitationController::class, 'storeFront'])->name('invite.front');
Route::post('/api/scan', [InvitationController::class, 'scan'])->name('api.scan');
Route::get('/qr/{id}', [InvitationController::class, 'qrImage'])->name('qr.image');
Route::get('/invite', [InvitationController::class, 'create']);
Route::post('/invite', [InvitationController::class, 'store']);
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Invitation (tamu RSVP)
    Route::resource('invitation', InvitationController::class);

    // Produk (makanan & aksesoris)
    Route::resource('produk', ProdukController::class);
    Route::get('/scan', [InvitationController::class, 'scanner'])->name('scanner');

    // Aksesoris (jika ingin dipisah dari produk)
    // Route::resource('aksesoris', AksesorisController::class);

});