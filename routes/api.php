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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return 'halo';
});

$router->get('/category', [
    'as' => 'api.getCategory',
    'uses' => 'CategoryController@index',
    'middleware' => 'jwt.verify',
]);
$router->group(['prefix' => 'product'], function () use ($router) {
    $router->get('/', [
        'as' => 'api.getProduct',
        'uses' => 'ProductController@index',
        'middleware' => 'jwt.verify',
    ]);
    $router->get('/{id}', [
        'as' => 'api.DetailProduct',
        'uses' => 'ProductController@detail',
        'middleware' => 'jwt.verify',
    ]);
    
    $router->post('/store', [
        'as' => 'api.storeProduct',
        'uses' => 'ProductController@store',
        'middleware' => 'jwt.verify',
    ]);
    $router->get('/view_delete', [
        'as' => 'api.viewDelProduct',
        'uses' => 'ProductController@view_delete',
        'middleware' => 'jwt.verify',
    ]);
    $router->delete('/delete/{id}', [
        'as' => 'api.delProduct',
        'uses' => 'ProductController@delete',
        'middleware' => 'jwt.verify',
    ]);
});
