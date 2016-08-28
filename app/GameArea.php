<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * A GameArea is a single semantic area (e.g. field, city) which spans across
 * multiple GameTiles, and consists of multiple GameAreaElements.
 * 
 * @package App
 */
class GameArea extends Model
{
    //

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function elements()
    {
        return $this->hasMany(GameAreaElement::class);
    }

    public function minions()
    {
        return $this->hasManyThrough(Minion::class, GameAreaElement::class);
    }


    public function minionCount()
    {
       return $this->minions()->count();
    }

}
