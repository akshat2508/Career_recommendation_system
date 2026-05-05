<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerController;

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
use App\Models\Recommendation;

Route::get('/dashboard', function () {
    
        $latest = Recommendation::where('user_id', auth()->id())
    ->latest()
    ->first();

$history = Recommendation::where('user_id', auth()->id())
    ->latest()
    ->skip(1)
    ->get();

return view('dashboard', compact('latest', 'history'));

})->middleware(['auth'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/career', [CareerController::class, 'create'])->name('career.create');
    Route::post('/career', [CareerController::class, 'store'])->name('career.store');
});

Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');

require __DIR__.'/auth.php';
