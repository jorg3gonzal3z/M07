<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FormulariController;
use App\Http\Controllers\CrudController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*email*/
Route::get('/send/email', [MailController::class, 'mail'])->middleware(['auth']);

/*formulari*/
Route::get('/formulari', [FormulariController::class, 'formulari'])->middleware(['auth'])->name('formulari');
Route::post('/formulari/dades', [FormulariController::class, 'dades'])->middleware(['auth'])->name('formulari.dades');

/*CRUD*/
/*formulari*/
Route::get('/crud', [CrudController::class, 'form'])->middleware(['auth'])->name('crud');
/*info*/
Route::get('/crud/info/{id}', [CrudController::class, 'show'])->middleware(['auth'])->name('libro.show');
/*create*/
Route::get('/crud/create', [CrudController::class, 'create'])->middleware(['auth'])->name('libro.create');
Route::post('/crud/create', [CrudController::class, 'store'])->middleware(['auth'])->name('libro.store');
/*eliminar*/
Route::delete('/crud/delete/{id}', [CrudController::class, 'destroy'])->middleware(['auth'])->name('libro.delete');
/*editar*/
Route::get('/crud/edit/{id}', [CrudController::class, 'edit'])->middleware(['auth'])->name('libro.edit');
Route::put('/crud/edit/{id}', [CrudController::class, 'update'])->middleware(['auth'])->name('libro.update');

require __DIR__.'/auth.php';


Route::resource('mascotas', App\Http\Controllers\MascotaController::class);