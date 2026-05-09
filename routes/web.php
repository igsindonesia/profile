<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\SetLocale;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Redirect root to default locale
Route::get('/', fn () => redirect('/'.config('app.locale')));

Route::prefix('{locale}')->whereIn('locale', ['id', 'en'])->middleware([SetLocale::class])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('home');

    // Blog routes
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

    // Category routes
    Route::get('/book-writings', [CategoryController::class, 'bookWritings'])->name('book-writings');
    Route::get('/community-services', [CategoryController::class, 'communityServices'])->name('community-services');
    Route::get('/conferences', [CategoryController::class, 'conferences'])->name('conferences');
    Route::get('/education', [CategoryController::class, 'education'])->name('education');
    Route::get('/institution-positions', [CategoryController::class, 'institutionPositions'])->name('institution-positions');
    Route::get('/intellectual-properties', [CategoryController::class, 'intellectualProperties'])->name('intellectual-properties');
    Route::get('/organizations', [CategoryController::class, 'organizations'])->name('organizations');
    Route::get('/policy-experiences', [CategoryController::class, 'policyExperiences'])->name('policy-experiences');
    Route::get('/publications', [CategoryController::class, 'publications'])->name('publications');
    Route::get('/research', [CategoryController::class, 'research'])->name('research');
    Route::get('/teaching-experiences', [CategoryController::class, 'teachingExperiences'])->name('teaching-experiences');
    Route::get('/teaching-materials', [CategoryController::class, 'teachingMaterials'])->name('teaching-materials');
    Route::get('/trainings', [CategoryController::class, 'trainings'])->name('trainings');

    Route::get('/category', function () {
        return Inertia::render('category');
    })->name('category');

    Route::get('/contact', function () {
        $personalInfo = PersonalInfo::first();

        return Inertia::render('contact', [
            'personal_info' => $personalInfo ? [
                'name' => $personalInfo->name,
                'institution' => $personalInfo->institution,
                'address_office' => $personalInfo->address_office,
                'phone' => $personalInfo->phone,
                'email' => $personalInfo->email,
            ] : null,
        ]);
    })->name('contact');
});
