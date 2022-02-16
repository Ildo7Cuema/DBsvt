<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Loja\CategoriaController;
use App\Http\Livewire\Loja\ProdutoController;
use App\Http\Livewire\Loja\FuncionarioController;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    route::get('dashboard', function(){
        return view('dashboard');
        
    })->name('dashboard');


    //========================================================================================
    //=========================== routa de codificação da loja ===============================
    route::get('/categoria', CategoriaController::class)->name('categoria');
    route::get('/produtos', ProdutoController::class )->name('produtos');
    route::get('/funcionarios', FuncionarioController::class )->name('funcionarios');
    
});
