<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/door-store', [DoorController::class, 'store'])->name('doorStore');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/tel', function (){
    \Illuminate\Support\Facades\Http::post('https://api.telegram.org/bot6632502241:AAGgvnrqoPa7fv-EtJZT9emstzwZlQdpxEI/sendMessage',[
        'chat_id' => 406438688,
        'text' => 'привет'
    ]);
});




