<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Rollbar\Rollbar;

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

Route::get('/', function () {


    $token = getenv("MAILTRAP_API_TOKEN");
    if (empty($token)) {
        $data = null;
    } else {
        $data = json_decode(file_get_contents("https://mailtrap.io/api/v1/inboxes.json?api_token={$token}"));
    }
    var_dump($data);


    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
