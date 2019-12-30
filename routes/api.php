<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['middleware' => ['cors']], function() {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@authenticate');
    Route::post('/logout', 'UserController@logout');
    Route::post('/image/upload', 'FileController@uploadImage');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('/user', 'UserController@getAuthenticatedUser');
        Route::get('/posts/paginate', 'PostController@getPostsPaginate');
        Route::resource('/posts', 'PostController');
        // Route::get('/posts', 'PostController@index');
        // Route::get('/posts/{id}', 'PostController@show');
        // Route::post('/posts/{id}', 'PostController@update');
        // Route::delete('/posts/{id}', 'PostController@destroy');
    });
});

