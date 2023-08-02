<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function (){
    Route::get('/dashboard', function () {
        return Inertia::render( 'Dashboard');
    })->name('dashboard');

    Route::get('/assign-to-me',[\App\Http\Controllers\TaskController::class,'assignToMe'])->name('tasks.assigned');
    Route::resource('tasks',\App\Http\Controllers\TaskController::class);

//    Task status routes
    Route::get('/task-start/{id}',[\App\Http\Controllers\TaskStatusController::class,'taskStart'])->name('task.start');
    Route::get('/task-done/{id}',[\App\Http\Controllers\TaskStatusController::class,'taskDone'])->name('task.done');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
