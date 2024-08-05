<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubGruposController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/', [IndexController::class, 'index'])->name('index.pesquisa');
Route::get('/produto/{produto}', [IndexController::class, 'detalhes'])->name('index.detalhes');
Route::get('/lojas', [IndexController::class, 'lojas'])->name('index.lojas');
Route::get('/subgrupos/{id}', [IndexController::class, 'getsubgrupos'])->name('index.subgrupos');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/csv', [ProdutosController::class, 'importCsv'])->name('csv');

    Route::resource('/produtos', ProdutosController::class);
    Route::post('/produtos/deleteall', [ProdutosController::class, 'deletarTodos'])->name('produtos.deleteall');

    Route::resource('/users', UsersController::class);
    Route::resource('/marcas', MarcasController::class);
    Route::resource('/grupos', GruposController::class);
    Route::resource('/sub_grupos', SubGruposController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ROTAS DE COMANDOS NO PHP
    Route::get('migration', function () {
        Artisan::call('migrate');
    });
});



require __DIR__.'/auth.php';
