 <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\StatelessUser;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['stateless.auth'])->group(function () {
    Route::post('/queue/create', 'ApiQueueController@create');
	Route::post('/queue/delete', 'ApiQueueController@delete');
	Route::post('/content/add', 'ApiQueueController@add');
	Route::post('/content/get', 'ApiQueueController@get');
});