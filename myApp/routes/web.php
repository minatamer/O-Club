<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitMeetingController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/bookameeting', function () {
    return view('bookameeting');
});

Route::post('/submitMeeting', [SubmitMeetingController::class, 'submitMeeting'])-> name('submitMeeting');
