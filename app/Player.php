<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    //

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function minions()
    {
        return $this->hasMany(Minion::class);
    }

    public function placeMinionOn(GameAreaElement $element, $type)
    {
        $minion = $this->minions()->type($type)->unplaced()->first();

        if(is_null($minion)){
            throw Exception('No More minions of that type available');
        }
        $minion->element()->associate($element);
        $minion->save();
    }
}
