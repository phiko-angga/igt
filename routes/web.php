<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPrivilegeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PostoController;
use App\Http\Controllers\SucoController;
use App\Http\Controllers\AldeiaController;
use App\Http\Controllers\CommActivityAuthController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\GetSelectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('/login', [AuthController::class,'authenticate']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[WelcomeController::class,'index']);
    Route::get('welcome',[WelcomeController::class,'index']);

    Route::resource('setting/user', UserController::class)->name('*','user');
    Route::resource('setting/user-privilege', UserPrivilegeController::class)->name('*','user-privilege');

    Route::resource('master/municipio', MunicipioController::class)->name('*','municipio'); //kotamadya
    Route::resource('master/posto', PostoController::class)->name('*','posto'); //tempat
    Route::resource('master/suco', SucoController::class)->name('*','suco');
    Route::resource('master/aldeia', AldeiaController::class)->name('*','aldeia'); //desa
    Route::resource('master/position', PositionController::class)->name('*','position');
    Route::resource('master/comm-activity-auth', CommActivityAuthController::class)->name('*','comm-activity-auth');
    Route::resource('master/corporate', CorporateController::class)->name('*','corporate');

    Route::resource('transaction/worker', WorkerController::class)->name('*','worker');
    Route::resource('transaction/supervision', UserController::class)->name('*','supervision');

    Route::get('/get-select/municipio', [GetSelectController::class,'getMunicipio']);
    Route::get('/get-select/posto', [GetSelectController::class,'getPosto']);
    Route::get('/get-select/suco', [GetSelectController::class,'getSuco']);
    Route::get('/get-select/aldeia', [GetSelectController::class,'getAldeia']);
    Route::get('/get-select/comm-activity-auth', [GetSelectController::class,'getCommActAuth']);
    Route::get('/get-select/corporate', [GetSelectController::class,'getCorporate']);
    Route::get('/get-select/position', [GetSelectController::class,'getPosition']);

    Route::get('/logout', [AuthController::class,'logout']);
});
