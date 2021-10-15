<?php

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

/**
 * Login Route
 */
$router->get('/login', [
    'as' => 'login',
    'uses' => 'LoginController@index',
]);
$router->post('/login', [
    'as' => 'submit-login',
    'uses' => 'LoginController@store',
]);

$router->get('/logout', [
    'as' => 'logout',
    'uses' => 'LogoutController@index',
]);


/**
 * Index Route
 */
$router->get('/', [
    'as' => 'index',
    'uses' => 'IndexController@index',
]);

$router->get('/dashboard', [
    'as' => 'index',
    'uses' => 'IndexController@index',
]);

$router->group(['prefix' => 'organization'], function () use ($router) {
    $router->get('/', [
        'as' => 'organization.index',
        'uses' => 'OrganizationController@index',
    ]);
    $router->get('/load', [
        'as' => 'organization.load',
        'uses' => 'OrganizationController@load',
    ]);
    $router->get('/detail/{id}', [
        'as' => 'organization.detail',
        'uses' => 'OrganizationController@detailWeb',
    ]);
    $router->get('/form', [
        'as' => 'organization.form',
        'uses' => 'OrganizationController@form',
    ]);
    $router->get('/form_edit', [
        'as' => 'organization.formEdit',
        'uses' => 'OrganizationController@formEdit',
    ]);
    $router->post('/store', [
        'as' => 'organization.store',
        'uses' => 'OrganizationController@store',
    ]);
    $router->post('/view-delete', [
        'as' => 'organization.view.delete',
        'uses' => 'OrganizationController@viewDelete',
    ]);
    $router->post('/delete', [
        'as' => 'organization.delete',
        'uses' => 'OrganizationController@delete',
    ]);
});

$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('/', [
        'as' => 'user.index',
        'uses' => 'UserController@index',
    ]);
    $router->get('/load', [
        'as' => 'user.load',
        'uses' => 'UserController@load',
    ]);
    $router->get('/form', [
        'as' => 'user.form',
        'uses' => 'UserController@form',
    ]);
    $router->post('/store', [
        'as' => 'user.store',
        'uses' => 'UserController@store',
    ]);
    $router->post('/view-delete', [
        'as' => 'user.view.delete',
        'uses' => 'UserController@viewDelete',
    ]);
    $router->post('/delete', [
        'as' => 'user.delete',
        'uses' => 'UserController@delete',
    ]);
});



/**Person */
$router->group(['prefix' => 'person'], function () use ($router) {
    /**Index */
    $router->get('/load', [
        'as' => 'person.load',
        'uses' => 'PersonController@load',
    ]);
    /**Store */
    $router->post('/form', [
        'as' => 'person.form',
        'uses' => 'PersonController@form',
    ]);

    $router->post('/store', [
        'as' => 'person.store',
        'uses' => 'PersonController@store',
    ]);

    $router->post('/view-delete', [
        'as' => 'person.view.delete',
        'uses' => 'PersonController@viewDelete',
    ]);

    $router->post('/delete', [
        'as' => 'person.delete',
        'uses' => 'PersonController@delete',
    ]);    
});