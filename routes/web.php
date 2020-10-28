<?php

use App\Http\Controllers\ChecklistController;
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
Route::any('/cart/{id}','ListingController@index')->name('cart.id');
Route::post('/get/model','ListingController@getmodel')->name('get.model');
Route::get('/new','ListingController@new')->name('new');
Route::post('/listings','ListingController@store')->name('listings');
Route::get('/listingsedit/{listing_id}', 'ListingController@edit')->name('listings.edit');
Route::post('/listing/update','ListingController@update')->name('listing.update');
Route::get('/listingsdelete/{listing_id}', 'ListingController@destroy');
Route::get('update/items','ListingController@updateItems')->name('update.items');
Route::post('update/files','ListingController@storedata')->name('update.files');
Route::get('delete/files/{id}','ListingController@deletefiles')->name('delete.files');
Route::post('get/model/checklist','ListingController@getchecklist')->name('get.model.checklist');

// Carts Controller //
Route::get('listing/{listing_id}/card/new', 'CardsController@new')->name('new.card');
Route::post('add/listing/carts', 'CardsController@store')->name('add.listing.carts');
Route::get('listing/{listing_id}/card/{card_id}', 'CardsController@show')->name('listing.listingid.card.cardid.edit');
Route::get('/listing/{listing_id}/card/{card_id}/edit', 'CardsController@edit')->name('listing.listingid.card.cardid');
Route::post('update/listing/carts', 'CardsController@updatecard')->name('card.update');
Route::get('listing/{listing_id}/card/{card_id}/delete', 'CardsController@destroy')->name('delete.carts');

// Board Controller //
Route::get('boards','BoardControllers@index')->name('boards');
Route::post('boards/add','BoardControllers@boardstore')->name('boards.add');
Route::get('boards/delete/{board_id}','BoardControllers@boarddelete')->name('boards.delete');
Route::get('testing','BoardControllers@testing')->name('testing');

// Checklist Controller and Comment data Store,Label,Store files store //
Route::post('check/title','ChecklistController@storetitle')->name('check.title');
Route::get('check/title/delete/{checktitle_id}','ChecklistController@deletechecktitle')->name('check.title.delete');
Route::post('check/list','ChecklistController@storelist')->name('check.list');
Route::get('check/list/delete/{list_id}','ChecklistController@deletechecklist')->name('check.list.delete');
Route::post('comment','ChecklistController@storecomment')->name('comment');
Route::get('comment/delete/{comment_id}','ChecklistController@commentdelete')->name('comment.delete');
Route::post('label','ChecklistController@storelabel')->name('label');
Route::post('files/upload','ChecklistController@storefiles')->name('files.upload');





