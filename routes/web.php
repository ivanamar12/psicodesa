<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\SecretariaController;

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
    Route::get('/', [SecretariaController::class, 'index'])->name('secretarias.index'); 
    Route::post('/', [SecretariaController::class, 'store'])->name('secretarias.store'); 
    Route::get('/{id}', [SecretariaController::class, 'show'])->name('secretarias.show'); 
    Route::put('/{id}', [SecretariaController::class, 'update'])->name('secretarias.update'); 
    Route::delete('/{id}', [SecretariaController::class, 'destroy'])->name('secretarias.destroy'); 
});
