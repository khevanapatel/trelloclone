<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

// Home Page //
// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', function(){ return view('welcome'); });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

// Login And Register //
Auth::routes();

// Listing Controller //
Route::any('/cart/{id}','ListingController@index')->name('cart/id');
Route::post('/get/model','ListingController@getmodel')->name('get/model');
Route::get('/new','ListingController@new')->name('new');
Route::post('/listings','ListingController@store')->name('listings');
Route::get('/listingsedit/{listing_id}', 'ListingController@edit')->name('listingsedit');
Route::post('/listing/edit','ListingController@update')->name('listing/edit');
Route::get('/listingsdelete/{listing_id}', 'ListingController@destroy');
Route::get('update/items','ListingController@updateItems')->name('update/items');
Route::post('update/files','ListingController@storedata')->name('update/files');
Route::post('files/upload','ListingController@storefiles')->name('files/upload');
Route::get('delete/files/{id}','ListingController@deletefiles')->name('delete/files');

// Carts Controller //
Route::get('listing/{listing_id}/card/new', 'CardsController@new')->name('new/card');
Route::post('add/listing/carts', 'CardsController@store')->name('add/listing/carts');
Route::get('listing/{listing_id}/card/{card_id}', 'CardsController@show')->name('listing/listingid/card/cardid/edit');
Route::get('/listing/{listing_id}/card/{card_id}/edit', 'CardsController@edit')->name('listing/listingid/card/cardid');
Route::post('card/update', 'CardsController@update')->name('card/update');
Route::get('listing/{listing_id}/card/{card_id}/delete', 'CardsController@destroy')->name('delete');

// Board Controller //
Route::get('boards','BoardControllers@index')->name('boards');
Route::post('boards/add','BoardControllers@boardstore')->name('boards/add');





