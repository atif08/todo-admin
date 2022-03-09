<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
//Route::get('register', [AuthController::class,'showRegistrationForm'])->name('showRegistrationForm');
//Route::post('register', [AuthController::class,'register'])->name('register');

//Auth::routes(['register' => false]);
//Route::get('register', [RegisterController::class, 'register']);
//Auth::routes();
Route::get('publications/{publication}/transaction/{id}/create-pdf', [TransactionController::class, 'createPDF']);
Route::get("{any}", [HomeController::class, 'index'])->where("any", ".*");
Route::get('test',function (){ return 'sdfsdfsdf'; });
//Route::get('/login',[HomeController::class, 'index']);
//Route::get('/{any?}/{par?}/{prmas?}/{param?}',[HomeController::class, 'index']);
\Illuminate\Support\Facades\Auth::routes(['register' => false]);

Route::middleware('auth:sanctum')->get('/', function () {
    return view('welcome');
});
/*Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');*/

Route::get('/publishers-package', [PublisherController::class, 'index'])->name('publishers-package');
