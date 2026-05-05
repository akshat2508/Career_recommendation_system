<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerController;
use App\Models\Recommendation;

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

    $user = auth()->user();

    $recommendations = \App\Models\Recommendation::where('user_id', $user->id)->get();

    $userSkills = $user->skills->pluck('name')->map(fn($s) => strtolower(trim($s)))->toArray();

    $best = null;
    $bestScore = -1;

    foreach ($recommendations as $rec) {
        $required = collect($rec->required_skills ?? [])
            ->map(fn($s) => strtolower(trim($s)))
            ->toArray();

        $matched = array_intersect($required, $userSkills);

        $score = count($required) > 0 ? round((count($matched)/count($required))*100) : 0;

        if ($score > $bestScore) {
            $bestScore = $score;
            $best = $rec;
        }

        $rec->matchScore = $score;
    }

    // ✅ ADD THIS
    $latest = $recommendations->sortByDesc('created_at')->first();

    return view('dashboard', [
        'best' => $best,
        'latest' => $latest,
        'history' => $recommendations,
        'userSkills' => $userSkills
    ]);

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

Route::get('/career/{id}/pdf', [CareerController::class, 'exportPdf'])
    ->name('career.pdf')
    ->middleware('auth');
    
require __DIR__.'/auth.php';
