<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
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

//Only Admin access API
Route::post('user/register',[UserController::class,'addUser']);

Route::middleware(['auth:api'])->group(function(){

    Route::post('user/event/add',[EventController::class,'addEvent']);
    
    Route::get('event/{event_id}',[EventController::class,'getEventById']);
    
    Route::get('event/fetch/allEvents',[EventController::class,'fetchAllEvents']);
    
    Route::delete('event/delete/{event_id}',[EventController::class,'deleteEvent']);
    
    Route::post('user/event/update/{event_id}',[EventController::class,'updateEvent']);
});


//Route::post('event/{event_id}/update/ticket/{ticket_id} ',[EventController::class,'updateTicket'])->middleware('auth:api');

//public routes below
Route::get('public/event/{event_id}',[RegistrationController::class,'getEventByIdForEventRegistration']);

Route::post('public/event/{event_id}/register',[RegistrationController::class,'eventRegister']);

Route::get('public/events',[RegistrationController::class,'fetchAllEventPublic']);

Route::post('event/{event_id}/register/{registration_id}',[RegistrationController::class,'registrationPaymentConfirmation']);




