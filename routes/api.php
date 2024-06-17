<?php

/*use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ReplySupportApiController;
use App\Http\Controllers\Api\SupportController;*/
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::apiResource('/users',UserController::class);

/*Route::delete('/users/{id}',[UserController::class,'destroy']);

Route::patch('/users/{id}', [UserController::class, 'update']);

Route::get('/users/{id}',[UserController::class, 'show']);

Route::get('/users',[UserController::class, 'index']);

Route::post('/users',[UserController::class, 'store']);*/

route::get('/', function (){
    return response()->json([
       'success' => true
    ]);
});

Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/replies/{support_id}', [ReplySupportApiController::class, 'getRepliesFromSupport']);
    Route::post('/replies/{support_id}', [ReplySupportApiController::class, 'createNewReply']);
    Route::delete('/replies/{id}', [ReplySupportApiController::class, 'destroy']);

    Route::apiResource('/supports', SupportController::class);
});
// Route::apiResource('/supports', SupportController::class)->middleware('auth');
