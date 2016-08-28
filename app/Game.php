<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use \App\Tile;
use \App\GameArea;

use Illuminate\Support\Facades\DB;

class Game extends Model
{
    //

    protected $dates = ['started_at', 'created_at', 'updated_at'];


    public function tiles()
    {
        return $this->hasMany(GameTile::class);
    }

    public function placedtiles()
    {
        return $this->tiles()->placed()->with('basetile')->get();
    }

    public function placedminions()
    {
        return $this->minions()->with('element.tile')->placed()->get();
    }

    public function areas()
    {
        return $this->hasMany(GameArea::class);
    }

    public function elements()
    {
        return $this->hasManyThrough(GameAreaElement::class, GameTile::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function minions()
    {
        return $this->hasManyThrough(Minion::class, Player::class);
    }

    /**
     * Seeds the Game's stack of tiles with the base tiles.
     */
    public function addTiles()
    {
        $turnid = 1;


        Tile::all()->each(function ($tile) use ($turnid) {

            $gametile = new GameTile();
            $gametile->tile_id = $tile->id;
            $gametile->turnid = $turnid;

            $this->tiles()->save($gametile);

            $turnid++;

        });

    }

    // TODO: This will have to be triggered on game start;
    public function addMinions()
    {
        for ($i = 0; $i < 10; $i++) {
            foreach ($this->players as $player) {
                $player->minions()->create(['type' => 1]);
            }
        }
    }


    public function addPlayerFor(User $user, $nickname)
    {

        $p = new Player();
        $p->nickname = $nickname;
        $p->user()->associate($user);

        $this->players()->save($p);

    }


    public function getNextTile()
    {
        return $this->tiles()->with('game', 'basetile')->unplaced()->first();
    }
    

}
