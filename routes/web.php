<?php

use App\Http\Controllers\AcademicDisciplineController;
use App\Http\Controllers\LearningClassController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Models\LearningClass;
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
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:Super Admin|Admin|Teacher']], function () {
        Route::get('discipline/my_discipline', [AcademicDisciplineController::class, 'myDiscipline'])->name('discipline.teacher.my_discipline');
        Route::get('discipline/my_discipline/{discipline}', [AcademicDisciplineController::class, 'myDisciplineClasses'])->name('discipline.teacher.my_discipline_classes');
        Route::get('discipline/my_discipline/{discipline}/{learning_class}', [AcademicDisciplineController::class, 'myDisciplineClassStudents'])->name('discipline.teacher.my_discipline_class_students');

        Route::get('/point/create_point_user/{discipline}/{user}', [PointController::class, 'createPointUser'])->name('point.create_point_user');


        
    });

    Route::group(['middleware' => ['role:Super Admin|Admin']], function () {
        
        Route::get('/point/classes', [PointController::class, 'classes'])->name('point.classes');
        Route::get('/point/discipline_list/{learning_class}', [PointController::class, 'disciplineList'])->name('point.discipline_list');
        Route::get('/point/discipline_list/{learning_class}/{discipline}', [PointController::class, 'disciplinePointsList'])->name('point.discipline_points_list');
        Route::get('/point/edit_point_user/{discipline}/{user}', [PointController::class, 'editPointUser'])->name('point.edit_point_user');

        Route::resource('discipline', AcademicDisciplineController::class);
        Route::resource('learning_class', LearningClassController::class);


        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/{user}', [PermissionController::class, 'show'])->name('permissions.show');
        Route::patch('/permissions/{user}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{user}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    Route::resource('point', PointController::class);
});



require __DIR__ . '/auth.php';
