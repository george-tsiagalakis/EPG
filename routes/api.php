<?php

use App\Channel;
use App\Http\Resources\Channel as ChannelResource;
use App\Http\Resources\Programme as ProgrammeResource;
use App\Http\Resources\Timetable as TimetableResource;
use App\Programme;
use App\Timetable;
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

        // Channel listing
        Route::get('', function () {
            return response()->json(ChannelResource::collection(Channel::all()));
        })->name('channels');


        // Programme info
        Route::get('{channel_uuid}/programmes/{programme_uuid}', function ($channel_uuid, $programme_uuid) {
            $filtered = Timetable::where([ ['programme_id', '=', $programme_uuid], ['channel_id', '=', $channel_uuid] ])->get();
            return response()->json(TimetableResource::collection($filtered));
        })->name('programme_information');


        // Programme timetable
        // Timezone as "Continent/City" as per https://www.php.net/manual/en/timezones.php, part B optional to allow for part A as "UTC", "GMT" etc
        Route::get('{channel_uuid}/{date}/{timezone_part_A}/{timezone_part_B?}', function ($channel_uuid, $date, $timezone_part_A, $timezone_part_B = null) {
            $timezone = $timezone_part_A . (empty($timezone_part_B) ?: '/' . $timezone_part_B);
            $filtered = App\Timetable::channel($channel_uuid)->date($date)->timezone($timezone)->get();

            return response()->json(TimetableResource::collection($filtered));
        })->name('programme_timetable');
    });
});

// Generic fallback on unknown URIs to some specified page or helpful message instead of standard 404
Route::fallback(function () {

    // e.g. get list of declared routes
    $routes = collect(Route::getRoutes())->reduce(function ($list = [], $route) {

       // and limit to api endpoints only
        substr($route->uri, 0, 3) !== 'api' ||
              strpos($route->uri, '{fallbackPlaceholder}') ?: $list[] = $route->uri;

        return $list;
    });

    $requested = parse_url(url()->current())['path']; // unknown route, so using url helper and getting the requested path
    $msg = ['requested' => $requested,
            'error' => 'Not found',
            'available' => $routes];

    // Customised 404
    return response()->json($msg, 404);
});
