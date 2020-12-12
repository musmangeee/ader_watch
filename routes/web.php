<?php

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



/*
 * Login & Registration Routes
 */

Auth::routes(['verify' => true]);
Route::get('signup', function () {
    return redirect('/register');
});
Route::post('signup', 'RegisterController@register')->name('signup');
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::resource('frontend/library', 'LibraryController');
Route::resource('frontend/shuffle', 'ShuffleController');
/*
 * Default users Routes
 */
Route::get('/', 'Frontend\FrontEndController@index')->name('user.index');
Route::get('search', 'SearchController@search')->name('search');
Route::get('all_cities', 'Frontend\FrontEndController@all_cities');
Route::get('list-business/{slug}', 'Frontend\BusinessController@index');
Route::get('user/{slug}', 'Frontend\ProfileController@index');
Route::get('autocomplete_locations', 'SearchController@autocomplete_locations')->name('autocomplete_locations');
Route::get('autocomplete_keyword', 'SearchController@autocomplete_keyword')->name('autocomplete_keyword');
Route::get('autocomplete_business', 'SearchController@autocomplete_business')->name('autocomplete_business');
Route::get('autocomplete_city', 'SearchController@autocomplete_city')->name('autocomplete_city');
Route::get('autocomplete_town', 'SearchController@autocomplete_town')->name('autocomplete_town');
Route::get('list_cities', 'SearchController@list_cities')->name('list_cities');
Route::group(['middleware' => ['check_business_role', 'check_admin_role']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('write_a_review', 'DefaultUser\ReviewController@writeareview')->name('search.business');
    Route::get('write_a_review/{slug}', 'DefaultUser\ReviewController@write_a_review_page')->name('write_a_review_store');
    Route::post('store_review', 'DefaultUser\ReviewController@postReview')->name('user.store.review');
    Route::post('/my/business/store', 'DefaultUser\BusinessController@store_business')->name('user.business.store');
    Route::get('/my/business/create', 'DefaultUser\BusinessController@create');
    Route::get('my/reviews', 'DefaultUser\ReviewController@index')->name('user.reviews');
    Route::get('my/profile', 'UserProfileController@index')->name('user.profile');
    Route::get('setting', 'DefaultUser\ProfileController@setting')->name('user.profile');
    Route::get('claim_business/{slug}', 'DefaultUser\BusinessController@claim_business')->name('user.claim_business');
    Route::post('store_claim_business', 'DefaultUser\BusinessController@store_claim_business')->name('user.store_claim_business');
    Route::get('view/{id}', 'ViewController@view');
    Route::post('view', 'ViewController@add_view')->name('save_view');
    Route::post('ad_review', 'DefaultUser\ReviewController@saveAjaxReview')->name('save_review_ajax');
});


/*
 * Business Routes
 */



Route::prefix('business')->group(function () {
    Route::group(['middleware' => ['check_admin_role', 'role:business']], function () {
        Route::get('/', 'BusinessUser\BusinessController@index')->name('individual.business.index');
        Route::get('setting', 'BusinessUser\BusinessController@setting');
        Route::get('business/reviews', 'BusinessUser\BusinessController@index');
        Route::resource('ads', 'AdsController');
    });
});


/*
 * Admin Routes
 */

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('business', 'AdminUser\BusinessController');
        Route::resource('business_category', 'AdminUser\BusinessCategoryController');
        Route::resource('city', 'AdminUser\CityController');
        Route::resource('town', 'AdminUser\TownController');
        Route::resource('claims', 'AdminUser\BusinessClaimController');
        Route::resource('packages', 'PackageController');
        Route::resource('adsview', 'ViewController');
        Route::post('verify_business', 'AdminUser\BusinessController@verify_business')->name('verify_business');
        Route::post('claim_business', 'AdminUser\BusinessClaimController@claim_business')->name('admin.claim_business');
    });
});


Route::get('email-verify', function () {
    dd(Auth::user()->sendEmailVerificationNotification());
});




/**
 * Testing
 */
Route::get('google-maps', function () {
    return view('test.search');
});
