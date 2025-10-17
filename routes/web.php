<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestePersonalidadeController;


Route::get('/teste-personalidade', [TestePersonalidadeController::class, 'show'])->name('teste.show');
Route::post('/teste-personalidade', [TestePersonalidadeController::class, 'submit'])->name('teste.submit');




