<?php

use App\Http\Controllers\AcademicDisciplineController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class,'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('discipline', AcademicDisciplineController::class);

    Route::group(['middleware' => ['role:Super Admin|Admin']], function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/{user}', [PermissionController::class, 'show'])->name('permissions.show');
        Route::patch('/permissions/{user}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{user}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });
});



require __DIR__.'/auth.php';


