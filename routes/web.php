<?php

use App\Http\Controllers\Dashboard\BooksController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ReviewController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Library;

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
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});
// Route::get('/dashboard', function () {
//     return view('dashboard.dashboard')
//         ->with([
//             'title' => 'Dashboard',
//             'active' => 'Dashboard',
//         ]);
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::middleware('role:admin,pustakawan')->group(function () {
//         Route::prefix('dashboard')->group(function () {
//             Route::prefix('perpustakaan')->group(function () {
//                 Route::resource('books', BooksController::class);

//                 Route::resource('category', CategoryController::class);
//             });
//         });
//     });

//     Route::middleware('role:admin')->group(function () {
//         Route::prefix('dashboard/pengaturan')->group(function () {
//             Route::resource('user', UserController::class);
//         });
//     });

//     Route::middleware('role:pembaca')->group(function () {
//         Route::prefix('dashboard')->group(function () {
//             Route::get('library', [LibraryController::class, 'index'])
//                 ->name('pustaka.index');
//             Route::get('library/{books}', [LibraryController::class, 'show'])
//                 ->name('pustaka.show');

//             Route::resource('collection', CollectionController::class);
//         });
//     });
// });

// Route::middleware('auth')->group(function () {
//     Route::prefix('dashboard')->group(function () {
//         Route::prefix('pengaturan')->group(function () {
//             Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
//             Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
//             Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
//         });

//         Route::resource('review', ReviewController::class);
//     });
// });

// // require __DIR__.'/auth.php';