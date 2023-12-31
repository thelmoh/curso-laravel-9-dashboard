<?php

use App\Http\Controllers\Admin\{
    AdminController,
    CourseController,
    DashboardController,
    LessonController,
    ModuleController,
    ReplySupportController,
    SupportController,
    UserController,
};
use App\Models\ReplySupport;
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

Route::prefix('admin')
        ->middleware('auth')
        ->group(function() {

    /*
        Routes ReplySupports
    */
    Route::post('/supports/{id}/reply', [ReplySupportController::class, 'store'])->name('replies.store');

    /*
        Routes Supports
    */
    Route::get('/supports/{id}', [SupportController::class, 'show'])->name('supports.show');
    Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

    /*
        Routes Lessons
    */
    Route::resource(
        name: '/modules/{moduleId}/lessons',
        controller: LessonController::class
    );

    /*
        Routes Modules
    */
    Route::resource(
        name: '/courses/{id}/modules',
        controller: ModuleController::class
    );


    /**
     * Routes Cursos
     */
    Route::resource('/courses', CourseController::class);

    /*
        Routes Admins
    */
    Route::put('/admins/{id}/update-image', [AdminController::class, 'uploadFile'])->name('admins.upload.file');
    Route::get('/admins/{id}/image', [AdminController::class, 'changeImage'])->name('admins.change.image');
    Route::resource('/admins', AdminController::class);

    /*
        Routes Users
    */

    Route::put('/users/{id}/update-image', [UserController::class, 'uploadFile'])->name('users.upload.file');
    Route::get('/users/{id}/image', [UserController::class, 'changeImage'])->name('users.change.image');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/',[DashboardController::class, 'index'])->name('dashboard.home');
});

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';