<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

use App\Http\Requests;

class GameController extends Controller
{
    
    public function currentstate(Game $game) {
    
    
        $output = [];
    
        $output['tiles'] = $game->placedtiles();
        $output['minions'] = $game->placedminions();
        $output['players'] = $game->players()->with('minions')->get();
        return $output;
    }
    
    
    public function board(Game $game) {
        return view('tiles', compact('game'));
    }
    
    
    public function nexttile(Game $game) {
        return ['nexttile' => $game->getNextTile()];
    }


}
