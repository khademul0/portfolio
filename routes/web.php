<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('post.show');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/resume/download', function () {
    return response()->download(storage_path('app/public/cv.pdf'), 'YourName-CV.pdf');
})->name('resume.download');
