<?php

namespace App;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Model;

class GameAreaElement extends Model
{
    //

    protected $appends = ['global_x', 'global_y'];

    /**
     * A game area element is part of a GameArea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(GameArea::class, 'game_area_id');
    }

    public function tile()
    {
        return $this->belongsTo(GameTile::class, 'game_tile_id');
    }


    public function minion()
    {
        return $this->hasOne(Minion::class);
    }


    public static function createFromArray($data)
    {
        $gae = new self;

        $gae->type = $data['name'];

        $gae->x = $data['coordinate'][0] * 100;
        $gae->y = $data['coordinate'][1] * 100;

        $gae->connections = 0 + $data['connections'];

        return $gae;
    }

    // X/y is from BOTTOM LEFT corner.

    // This is a rotation clockwise.
    public function rotate($rotation)
    {
        $this->x /= 100;
        $this->y /= 100;


        if($rotation == 90){
            $new_y = 1 - $this->x;
            $new_x = $this->y;
        }else if($rotation == 180){
            $new_x = 1 - $this->x;
            $new_y = 1 - $this->y;
        }else if($rotation == 270){
            $new_x = 1 - $this->y;
            $new_y = $this->x;
        }else if($rotation == 0){
            $new_y = $this->y;
            $new_x = $this->x;
        }else{
            return null;
        }

        $this->x = $new_x * 100;
        $this->y = $new_y * 100;

        $this->connections = $this->rotatebitwise($this->connections, $rotation / 30);

        return $this;
    }

    public static function rotatebitwise($value, $shift) {
        return ((($value << $shift) | ($value >> (12-$shift))) & 0xFFF);
    }

    public function scopeOnEdge($query, $edge)
    {
        return $query->whereRaw('connections & ? > 0', array($edge));
    }

    public function onEdge($edge){
        return ($this->connections & $edge) > 0;
    }

    public function scopeOrphaned($query){
        return $query->whereNull('game_area_id');
    }

    public function getGlobalXAttribute(){
        return $this->tile->x + $this->x / 100;
    }

    public function getGlobalYAttribute(){
        return $this->tile->y + $this->y / 100;
    }

}
