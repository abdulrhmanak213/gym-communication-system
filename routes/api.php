<?php

use App\Http\Controllers\Admin\AdminCoachController;
use App\Http\Controllers\Admin\AdminLogInController;
use App\Http\Controllers\Admin\AdminPlanesController;
use App\Http\Controllers\Admin\AdminPlayerController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Coach\CoachProfileController;
use App\Http\Controllers\Coach\PlayersController;
use App\Http\Controllers\Plane\PlaneController;
use App\Http\Controllers\Player\PlayerProfileController;
use App\Http\Controllers\Player\CoachesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::post('register/coach',[RegisterController::class,'coachRegister']);
Route::post('register/player',[RegisterController::class,'playerRegister']);
Route::post('/login/{type}',[LoginController::class,'login']);
Route::post('/AdminLogin',[AdminLogInController::class,'login']);

/*
/--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth.guard:admin', 'protected']], function() {
    Route::post('day/create',[DayController::class,'create']);
    Route::get('day/getAll',[DayController::class,'gatAll']);

    Route::post('admin/plane/create',[AdminPlanesController::class,'create']);
    Route::get('admin/plane/getAll',[AdminPlanesController::class,'getAll']);
    Route::get('admin/plane/get/{id}',[AdminPlanesController::class,'get']);
    Route::delete('admin/plane/delete/{id}',[AdminPlanesController::class,'delete']);
    Route::post('admin/plane/updateStatue/{id}',[AdminPlanesController::class,'updateStatus']);
    Route::post('admin/plane/updateSecurity/{id}',[AdminPlanesController::class,'updateSecurity']);


    Route::get('admin/player/getAll',[AdminPlayerController::class,'getAll']);
    Route::get('admin/player/get/{id}',[AdminPlayerController::class,'get']);
    Route::delete('admin/player/delete/{id}',[AdminPlayerController::class,'delete']);


    Route::get('admin/coach/getAll',[AdminCoachController::class,'getAll']);
    Route::get('admin/coach/get/{id}',[AdminCoachController::class,'get']);
    Route::delete('admin/coach/delete/{id}',[AdminCoachController::class,'delete']);


});

/*
|--------------------------------------------------------------------------
| COACH
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth.guard:coach', 'protected']], function() {
    Route::prefix('/coach')->group(function () {
        Route::get('/profile',[CoachProfileController::class,'profile']);
        Route::post('/profile/update',[CoachProfileController::class,'update']);
        Route::get('/myPlayers',[PlayersController::class,'getMyPlayers']);
        Route::post('/plane/create',[PlaneController::class,'create']);
        Route::post('/plane/updateStatue/{id}',[PlaneController::class,'updateStatus']);
    });
});
/*
|--------------------------------------------------------------------------
| PLAYER
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth.guard:player', 'protected']], function() {
    Route::prefix('/player')->group(function () {
        Route::get('/profile',[PlayerProfileController::class,'profile']);
        Route::post('/profile/update',[PlayerProfileController::class,'update']);

        Route::get('/AllCoaches',[CoachProfileController::class,'getAll']);
        Route::Post('/SelectCoach/{coach_id}',[CoachesController::class,'selectCoach']);
        Route::get('/getCoach/{id}',[CoachProfileController::class,'getCoach']);

        Route::get('/AllPlanes',[PlaneController::class,'getAll']);
        Route::get('/SelectPlane/{id}',[PlaneController::class,'selectPlane']);
    });
});

