<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

// Example API routes
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Debug all environment variables
Route::get('/debug-env', function () {
    return response()->json([
        'DB_CONNECTION' => env('DB_CONNECTION'),
        'DB_HOST' => env('DB_HOST'),
        'DB_PORT' => env('DB_PORT'),
        'DB_DATABASE' => env('DB_DATABASE'),
        'DB_USERNAME' => env('DB_USERNAME'),
        'DB_PASSWORD' => env('DB_PASSWORD') ? '***HIDDEN***' : 'NOT_SET',
        'MYSQLHOST' => env('MYSQLHOST'),
        'MYSQLDATABASE' => env('MYSQLDATABASE'),
        'MYSQLUSER' => env('MYSQLUSER'),
        'MYSQLPASSWORD' => env('MYSQLPASSWORD') ? '***HIDDEN***' : 'NOT_SET',
        'MYSQL_URL' => env('MYSQL_URL'),
        'RAILWAY_PRIVATE_DOMAIN' => env('RAILWAY_PRIVATE_DOMAIN'),
    ]);
});

// Debug database environment variables
Route::get('/debug-db', function () {
    return response()->json([
        'DB_CONNECTION' => env('DB_CONNECTION'),
        'DB_HOST' => env('DB_HOST'),
        'DB_PORT' => env('DB_PORT'),
        'DB_DATABASE' => env('DB_DATABASE'),
        'DB_USERNAME' => env('DB_USERNAME'),
        'DB_PASSWORD' => env('DB_PASSWORD') ? '***HIDDEN***' : 'NOT_SET',
    ]);
});

// Database connection test
Route::get('/db-test', function () {
    try {
        // Test database connection
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();

        return response()->json([
            'status' => 'success',
            'message' => 'Database connected successfully',
            'database' => $dbName,
            'timestamp' => now()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Database connection failed',
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::get('/user', function (Request $request) {
    return response()->json(['user' => 'John Doe']);
});

Route::post('/data', function (Request $request) {
    $data = $request->all();
    return response()->json(['received' => $data]);
});

// Profile API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});
