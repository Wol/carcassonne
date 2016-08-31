<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


use App\Game;
use App\User;
use Carbon\Carbon;



Route::get('/phpinfo', function () {
    phpinfo();
});


Route::get('/test', function () {

    // Create a new game

    $game = new Game();
    $game->status = 10;
    $game->started_on = Carbon::now();
    $game->save();

    $game->addPlayerFor(User::find(1), "Wol");


    $game->addMinions();

    $game->addTiles();


    $pl = $game->players()->first();

    $element = $game->placeTile($game->getNextTile(), 0, 0, 0)->get(3);
    $pl->placeMinionOn($element, 1);

    $element = $game->placeTile($game->getNextTile(), 0, 1, 90)->random();
    $pl->placeMinionOn($element, 1);

    $element = $game->placeTile($game->getNextTile(), 2, 0, 0)->get(2);
    $pl->placeMinionOn($element, 1);

    $element = $game->placeTile($game->getNextTile(), 2, -2, 0)->random();
    $pl->placeMinionOn($element, 1);

    $element = $game->placeTile($game->getNextTile(), 1, 0, 0)->random();
    $pl->placeMinionOn($element, 1);

    $element = $game->placeTile($game->getNextTile(), 0, -1, 270)->random();
    $pl->placeMinionOn($element, 1);

    //return $game;

    var_dump($game->id);

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    

    Route::get('/game/{game}/tiles', 'GameController@currentstate');
    Route::get('/game/{game}/board', 'GameController@board');
    Route::get('/game/{game}/nexttile', 'GameController@nexttile');


    Route::get('/tile/{gametile}/place/{x}/{y}', 'BoardController@rotationsat');

    Route::get('/tile/{gametile}/place/{x}/{y}/{rotation}', 'BoardController@placetile');

    Route::get('/element/{gameareaelement}/placeminion/{miniontype}', 'BoardController@placeminion');

    
});


Route::group(['prefix' => 'auth', 'middleware' => ['web']], function () {

    Route::auth();
});



