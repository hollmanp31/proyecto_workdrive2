<?php

use App\Models\Usuario;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController; 
Route::get('/', function () {
    return view('welcome');
}); 

/* Route::resource('usuarios', UsuarioController::class); */ // ruta para usar el controllador con todos los metodos - crud completo 
/* Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');  
 */
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index'); 
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store'); 
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

/* Route::resource('/usuarios', UsuarioController::class); */
/* Route::post('/usuario', UsuarioController::class);  */
