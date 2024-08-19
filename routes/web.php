<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::group(['prefix' => 'especialistas', 'middleware' => 'auth'], function () {
    Route::get('/', [EspecialistaController::class, 'indexweb'])->name('especialistas.index'); 
    Route::get('/data', [EspecialistaController::class, 'index'])->name('especialistas.data'); // Nueva ruta para JSON
    Route::post('/', [EspecialistaController::class, 'store'])->name('especialistas.store'); 
    Route::get('/{id}', [EspecialistaController::class, 'show'])->name('especialistas.show'); 
    Route::put('/{id}', [EspecialistaController::class, 'update'])->name('especialistas.update'); 
    Route::delete('/{id}', [EspecialistaController::class, 'destroy'])->name('especialistas.destroy'); 
});

Route::group(['prefix' => 'secretarias', 'middleware' => 'auth'], function () {
    Route::get('/', [SecretariaController::class, 'indexweb'])->name('secretarias.index'); 
    Route::get('/data', [SecretariaController::class, 'index'])->name('secretarias.data'); // Nueva ruta para JSON
    Route::post('/', [SecretariaController::class, 'store'])->name('secretarias.store'); 
    Route::get('/{id}', [SecretariaController::class, 'show'])->name('secretarias.show'); 
    Route::put('/{id}', [SecretariaController::class, 'update'])->name('secretarias.update'); 
    Route::delete('/{id}', [SecretariaController::class, 'destroy'])->name('secretarias.destroy'); 
});

Route::group(['prefix' => 'representantes', 'middleware' => 'auth'], function () {
    Route::get('/', [RepresentanteController::class, 'indexweb'])->name('representantes.index'); 
    Route::get('/data', [RepresentanteController::class, 'index'])->name('representantes.data'); // Nueva ruta para JSON
    Route::post('/', [RepresentanteController::class, 'store'])->name('representantes.store'); 
    Route::get('/{id}', [RepresentanteController::class, 'show'])->name('representantes.show'); 
    Route::put('/{id}', [RepresentanteController::class, 'update'])->name('representantes.update'); 
    Route::delete('/{id}', [RepresentanteController::class, 'destroy'])->name('representantes.destroy'); 
});

Route::group(['prefix' => 'pacientes', 'middleware' => 'auth'], function () {
    Route::get('/', [PacienteController::class, 'indexweb'])->name('pacientes.index'); 
    Route::get('/data', [PacienteController::class, 'index'])->name('pacientes.data'); // Nueva ruta para JSON
    Route::post('/', [PacienteController::class, 'store'])->name('pacientes.store'); 
    Route::get('/{id}', [PacienteController::class, 'show'])->name('pacientes.show'); 
    Route::put('/{id}', [PacienteController::class, 'update'])->name('pacientes.update'); 
    Route::delete('/{id}', [PacienteController::class, 'destroy'])->name('pacientes.destroy'); 
});