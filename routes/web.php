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
$careerPersonalityMap = [
    'devops engineer' => ['analytical', 'structured'],
    'cloud solutions architect' => ['analytical', 'structured'],
    'ui/ux designer' => ['creative'],
    'product manager' => ['social', 'analytical'],
    'data scientist' => ['analytical'],
];
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $user = auth()->user();

    $recommendations = \App\Models\Recommendation::where('user_id', $user->id)->get();

    $userSkills = $user->skills->pluck('name')->map(fn($s) => strtolower(trim($s)))->toArray();

    $best = $recommendations->first();
$latest = $recommendations->sortByDesc('created_at')->first();
    $personality = $user->profile->personality ?? [];

foreach ($recommendations as $rec) {

    // 🔹 Skill match
    $required = collect($rec->required_skills ?? [])
        ->map(fn($s) => strtolower(trim($s)))
        ->toArray();

    $matched = array_intersect($required, $userSkills);

    $skillScore = count($required) > 0
        ? (count($matched) / count($required)) * 100
        : 0;

    // 🔹 Personality match
    $careerKey = strtolower(trim($rec->career_name));
    $personalityScore = 0;

    if (isset($careerPersonalityMap[$careerKey])) {

        $traits = $careerPersonalityMap[$careerKey];
        $total = count($traits);
        $matchedTraits = 0;

        foreach ($traits as $trait) {
            if (($personality[$trait] ?? 0) >= 3) {
                $matchedTraits++;
            }
        }

        $personalityScore = ($total > 0)
            ? ($matchedTraits / $total) * 100
            : 0;
    }

    // 🔥 FINAL SCORE
    $finalScore = round(($skillScore * 0.7) + ($personalityScore * 0.3));

    $rec->matchScore = $finalScore;
    // 🔥 Explanation Engine

$matchedSkillCount = count($matched);
$totalSkills = count($required);

$topTraits = [];

foreach ($personality as $trait => $value) {
    if ($value >= 3) {
        $topTraits[] = $trait;
    }
}

$topTraits = array_slice($topTraits, 0, 2);

$rec->explanation = "Strong match because you have {$matchedSkillCount}/{$totalSkills} required skills"
    . (count($topTraits) ? " and your " . implode(' + ', $topTraits) . " personality aligns well." : ".");
}
$recommendations = $recommendations->sortByDesc('matchScore')->values();

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

    Route::get('/career', [CareerController::class, 'create'])
        ->name('career.create');

    Route::post('/career', [CareerController::class, 'store'])
        ->name('career.store');

    // 🔥 Resume Analyzer
    Route::get('/resume', [CareerController::class, 'resumeForm'])
        ->name('resume.form');

    Route::post('/resume/analyze', [CareerController::class, 'analyzeResume'])
        ->name('resume.analyze');
});
Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');

Route::get('/career/{id}/pdf', [CareerController::class, 'exportPdf'])
    ->name('career.pdf')
    ->middleware('auth');
    
Route::post('/chat', [CareerController::class, 'chat'])->name('career.chat');
Route::get('/personality', [CareerController::class, 'personalityForm'])->name('personality');
Route::post('/personality', [CareerController::class, 'personalitySubmit'])->name('personality.submit');
require __DIR__.'/auth.php';
