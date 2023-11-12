<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TagController;

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

/* コントローラーに遷移させたいとき
   '/'にアクセスすると
   GoalControllerクラスのindexメソッドが呼び出される
*/
Route::get('/', [GoalController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('goals', GoalController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('auth');

/* only()メソッドの引数にアクション名の配列を渡すことで一括設定するルーティングをそれらのアクションに限定できる
   なぜこの3つなのか？['store', 'update', 'destroy']
*/
Route::resource('goals.todos', TodoController::class)->only(['store', 'update', 'destroy'])->middleware('auth');

Route::resource('tags', TagController::class)->only(['store', 'update', 'destroy'])->middleware('auth');