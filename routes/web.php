<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestePersonalidadeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreNosController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/teste-personalidade', [TestePersonalidadeController::class, 'show'])->name('teste.show');
Route::post('/teste-personalidade', [TestePersonalidadeController::class, 'submit'])->name('teste.submit');
Route::get('/contato', [ContatoController::class, 'show'])->name('contato.show');
Route::post('/contato', [ContatoController::class, 'enviar'])->name('contato.enviar');
Route::get('/sobre-nos', [SobreNosController::class, 'show'])->name('sobrenos.show');


