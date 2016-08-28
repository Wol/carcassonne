<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minion extends Model
{
    //

    const Type_Standard = 1;
    const Type_Large = 2;
    const Type_Abbot = 3;
    const Type_Pig = 4;
    const Type_Builder = 5;


    protected $fillable = ['type'];

    protected $appends = ['x', 'y', 'placed_on'];

    protected $hidden = ['element', 'created_at', 'updated_at'];

    public function element(){
        return $this->belongsTo(GameAreaElement::class, 'game_area_element_id');
    }

    public function scopeUnplaced($query){
        return $query->whereNull('game_area_element_id');
    }

    public function scopePlaced($query){
        return $query->whereNotNull('game_area_element_id');
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getXAttribute(){
        return $this->element->global_x;
    }

    public function getYAttribute(){
        return $this->element->global_y;
    }

    public function getPlacedOnAttribute()
    {
        return $this->element->type;
    }
    public function placeOn(GameAreaElement $element)
    {
        $this->element()->associate($element);
        $this->save();
    }
}
