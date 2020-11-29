<?php

use App\Http\Controllers\Api\v1\GameController;
use App\Http\Controllers\Api\v1\JWTAuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1',

], function ($router) {

    /* Auth */
    $router->post('login', [JWTAuthController::class, 'login']);
    $router->post('register', [JWTAuthController::class, 'register']);
    $router->post('logout', [JWTAuthController::class, 'logout']);
    $router->post('refresh', [JWTAuthController::class, 'refresh']);

    /* user profile */
    $router->get('user-profile', [JWTAuthController::class, 'userProfile']);

    /* game */
    $router->group(['prefix' => 'game'], function ($router){
        $router->post('/method/index', [GameController::class, 'gameMethodLists']);

    });
});

