<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-new');
});

Route::get('/dashboard', function () {
    return view('dashboard-frozen');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Archive routes
    Route::resource('archives', ArchiveController::class);
    Route::get('archives/{archive}/download', [ArchiveController::class, 'download'])->name('archives.download');
    Route::get('archives/{archive}/force-download', [ArchiveController::class, 'forceDownload'])->name('archives.forceDownload');
    Route::get('category/{category}/archives', [ArchiveController::class, 'filterByCategory'])->name('archives.category');
});

require __DIR__.'/auth.php';
