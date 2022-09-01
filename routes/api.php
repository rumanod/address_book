<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AddressBookController;

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



Route::get('person/{name}', [AddressBookController::class, 'getPerson']);
Route::get('personemail/{email}', [AddressBookController::class, 'getPersonEmail']);
Route::get('persongroup/{groupname}', [AddressBookController::class, 'getPeopleGroup']);
Route::get('groupsperson/{peopleid}', [AddressBookController::class, 'getGroupsPerson']);


Route::post('person', [AddressBookController::class, 'createPerson']);
Route::post('group', [AddressBookController::class, 'createGroup']);

//Extra methods if they were needed.
Route::get('people', [AddressBookController::class,'getAllPeople']);

Route::put('person/{id}', [AddressBookController::class, 'updatePerson']);
Route::delete('person/{id}', [AddressBookController::class, 'deletePerson']);
