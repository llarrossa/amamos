<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MedicamentoController;
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
    return view('quem-somos');
})->name('index');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/quem-somos', function () {
    return view('quem-somos');
});

Route::get('/buscar/nome',      [BuscarController::class, 'buscarPorNome']);
Route::get('/buscar/categoria', [BuscarController::class, 'buscarPorCategoria']);
Route::get('/buscar/risco',     [BuscarController::class, 'buscarPorRisco']);

Route::get('/atualidades', function () {
    return view('atualidades');
});

Route::controller(AuthController::class)->group(function (){
    Route::get('/login','index')->name('login.index');
    Route::post('/login','store')->name('login.store');
    Route::get('logout','destroy')->name('logout');
});

Route::controller(CategoriaController::class)->group(function (){
    Route::get('/categoria','index')->name('categoria.index');
    Route::post('/categoria','store')->name('categoria.store');
    Route::get('/categoria/{id}/editar','edit')->name('categoria.edit');
    Route::post('/categoria/{id}/editar','update')->name('categoria.update');
    Route::delete('/categoria/{id}/excluir','destroy')->name('categoria.destroy');
});

Route::controller(MedicamentoController::class)->group(function (){
    Route::get('/medicamento','index')->name('medicamento.index');
    Route::post('/medicamento','store')->name('medicamento.store');
    Route::get('/medicamento/{id}/editar','edit')->name('medicamento.edit');
    Route::post('/medicamento/{id}/editar','update')->name('medicamento.update');
    Route::delete('/medicamento/{id}/excluir','destroy')->name('medicamento.destroy');
});

Route::get('/categorias/{id}', [MedicamentoController::class, 'getSubcategorias']);
