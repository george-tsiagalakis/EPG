<?php

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

// API versioning, URL + named routes
Route::group(['prefix' => 'v1', 'as' => 'v1_'], function () {

    // CHANNELS
	Route::group(['prefix' => 'channels', 'namespace' => 'Channels'], function () {

		Route::get('', function () {
			return 'channels';
		})->name('channels');

        // Endpoints containing fixed parts should be placed higher in order to avoid conflicts with other endpoints being fully parameterised with the  same number of parts; simpler with less maintainance and faster -in this particular case- than via where or global constraints
		Route::get('{channel_uuid}/programmes/{programme_uuid}', function ($channel_uuid, $programme_uuid) {
			return 'info';
		})->name('programme_information');

		Route::get('{channel_uuid}/{date}/{timezone}', function ($channel_uuid, $date, $timezone) {
			return 'timetable';
		})->name('programme_timetable');

	});
});

// Generic fallback to some specified page or helpful message instead of standard 404
Route::fallback(function () {

    // e.g. get list of declared routes
	$routes = collect(Route::getRoutes())->reduce(function ($list = [], $route) {

       // and limit to api endpoints only
       substr($route->uri, 0, 3) !== 'api' ||
              strpos($route->uri, '{fallbackPlaceholder}') ?: $list[] = $route->uri;

       return $list;
    });

    $requested = parse_url( url()->current() )['path']; // unknown route, so using url helper and getting the requested path
    $msg = ['requested' => $requested,
            'error'     => 'Not found',
            'available' => $routes];

     // Customised 404
     return response()->json($msg, 404);

});
