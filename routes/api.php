<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
////login route
Route::post("/login", [AuthController::class, "login"]);
////register route
Route::post("/register", [AuthController::class, "register"]);
/////forget password route - set a new token
Route::post("forgetpassword", [ForgetController::class, "forgetPassword"]);
/////reset password route - not work
Route::post("resetpassword", [ResetPassword::class, "resetpassword"]);
////get current user
Route::get("user", [UserController::class, "getUser"])->middleware("auth:api");
