<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importamos el PersonaController para poder asociarlo a la ruta
use App\Http\Controllers\PersonaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta POST para registrar personas. El prefijo '/api' se añade automáticamente.
// Cuando hagas POST a http://127.0.0.1:8000/api/personas, ejecutará el método 'store'
Route::post('/personas', [PersonaController::class, 'store']);