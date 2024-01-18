<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api/v1'], function ($router) {

    /**
     * UNAUTHENTICATED ROUTES
     */
    $router->group(
        ['prefix' => '/auth'],
        function($router)
        {
            $router->post('/login', 'AuthController@login');
            $router->post('/register', 'AuthController@register');
        }
    );

    /**
     * AUTHENTICATED ROUTES
     */
    $router->group(
    [
        'prefix' => '/auth',
        'middleware' => 'auth',
    ], function($router) {
        $router->post('/logout', 'AuthController@logout');
        $router->post('/refresh', 'AuthController@refresh');

        // $router->get('/test', function() {
        //     return 'Test authenticated';
        // });
    });

    $router->group(
        [
            'prefix' => '/check',
            'middleware' => [
                'auth',
                'role:Admin'
            ]
        ],
        function($router) {
            $router->get('/check', function() {
                return 'Check passed';
            });
        }
    );

    $router->group(
        [
            'prefix' => '/teams/',
        ],
        function($router) {
            $router->get('/', 'TeamController@index');
            $router->get('2/', 'TeamController@index2');
        }
    );
});
