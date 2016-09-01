<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameTile extends Model
{
    //

    protected $hidden = ['basetile', 'created_at', 'updated_at'];
    
    protected $appends = ['url'];


    public function getUrlAttribute()
    {
        return $this->basetile->url();
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function basetile()
    {
        return $this->belongsTo(Tile::class, 'tile_id');
    }

    public function elements()
    {
        return $this->hasMany(GameAreaElement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeAt($query, $x, $y)
    {
        return $query->where('x', $x)->where('y', $y);
    }


    public function neighbours()
    {
        $y = $this->y;
        $x = $this->x;

        return $this->hasMany(GameTile::class, 'game_id', 'game_id')->whereBetween('x', [$x - 1, $x + 1])->whereBetween('y', [$y - 1, $y + 1]);;
    }


    public function scopeUnplaced($query)
    {
        return $query->whereNull('user_id');
    }

    public function scopePlaced($query)
    {
        return $query->whereNotNull('user_id');
    }


    private function place($x, $y, $rotation, $user = null)
    {

        if(is_null($user)){
            $user = Auth::user();
        }

        // TODO: check to see whether the tile fits here and matches with something.

        // Place the tile in the grid where it should be
        $this->x = $x;
        $this->y = $y;
        $this->rotation = $rotation;
        $this->user()->associate($user);
        $this->save();

        $this->createElements();

    }


    /**
     * Creates the post-rotation elements into the GameAreaElements table.
     */
    private function createElements()
    {
        foreach ($this->basetile->elements as $element) {
            $gae = GameAreaElement::createFromArray($element);
            $gae->rotate($this->rotation);
            $this->elements()->save($gae);
        }
    }

    /**
     * Create new gamearea definitions for areas which haven't been connected into an existing gamearea
     */
    public function createAreasForOrphanedElements()
    {

        $orphanedelements = $this->elements()->orphaned()->get();

        foreach ($orphanedelements as $orphan) {
            $gamearea = new GameArea();
            $gamearea->type = $orphan->type;

            $this->game->areas()->save($gamearea);

            $gamearea->elements()->save($orphan);

        }

    }

    /**
     * Finds a list of areas which can have minions added into them, and don't already have existing minions there
     * @return mixed
     */
    public function getAvailableMinionPlacementAreas()
    {
        $elements = $this->elements()->with('area.minions')->get();

        return $elements->filter(function($element){
            return $element->area->minions->count() == 0;
        })->values();

    }


    /**
     * Finds the conncted GameAreaElement connected to the specified edge
     * @param $edge
     * @return mixed
     */
    public function elementOnEdge($edge)
    {
        return $this->elements->first(function($value) use($edge) { return ($value->connections & $edge) > 0;} );
    }


    public function elementOnBaseTileEdge($edge, $rotation)
    {
        foreach($this->basetile->elements as $element){

            $e = GameAreaElement::createFromArray($element);
            $e->rotate($rotation);

            if($e->onEdge($edge)){
                return $e;
            }
        }
    }

    // TODO :SORT THIS FUNCTION OUT!
    public function connectEdges()
    {

        // Loop through each edge of the tile, and see if we can merge any seams.
        foreach (TileElement::neighbours as $localedge => $edge) {

            // Use TileElement::neighbours to check the adjacent tiles.
            $tileoffset = $edge[1];

            $nx = $this->x + $tileoffset[0];
            $ny = $this->y + $tileoffset[1];

            $neighbour = $this->neighbours->where('x', $nx)->where('y', $ny)->first();

            if (!is_null($neighbour)) {

                $neighbourelement = $neighbour->elementOnEdge($edge[0]);
                $localelement = $this->elementOnEdge($localedge);

                if (is_null($localelement)) {
                    // This will be triggered if for example there isn't a road on a join
                    continue;
                }

                if (is_null($neighbourelement)) {
                    // This will be triggered if for example there isn't a road on a join
                    continue;
                }


                if (is_null($localelement->area_id)) {
                    // We are newly connecing to a piece. This is the majority of the situations
                    $newid = $neighbourelement->area->id;


                    $localelement->area()->associate($neighbourelement->area);
                    $localelement->save();

//                    echo "Adding element $localelement->type on edge $localedge at ($this->x , $this->y) to ($nx, $ny) to $newid<br/>";

                } else {


                    $oldid = $localelement->area->id;
                    $newid = $neighbourelement->area->id;

                    if($oldid == $newid){
                        // It already is the same, don't need to do anything:
//                        echo "Not Merging element $localelement->type on edge $localedge at ($this->x , $this->y) to ($nx, $ny) as the IDs were the same $oldid to $newid<br/>";

                        continue;
                    }

//                    echo "Merging element $localelement->type on edge $localedge at ($this->x , $this->y) to ($nx, $ny) from $oldid to $newid<br/>";

                    // Make sure we update the internal models so that the rest of the loop works with the new values.
                    $localelement->area()->associate($neighbourelement->area);

                    // The do the flush update of the database to move any elements on the old area ID to the new one.
                    $gaetable = (new GameAreaElement())->getTable();
                    DB::table($gaetable)->where('game_area_id', $oldid)->update(array('game_area_id' => $newid));

                    GameArea::destroy($oldid); // We've moved everything to the new ID, so remove the old area
                }

            }

        }
    }



    public function canBePlacedAt($x, $y, $rotation)
    {

        if( $this->neighbours->where('x', $x)->where('y', $y)->count() == 1 ){
            // There is a tile at this location already.
            return false;
        }


        $neighbourcount = 0;

//        echo "<h2>Checking $x, $y with rotation $rotation</h2><br/>";

        // Loop through each edge of the tile, and see if we can merge any seams.
        foreach (TileElement::neighbours as $localedge => $edge) {

            // Use TileElement::neighbours to check the adjacent tiles.
            $tileoffset = $edge[1];


            $nx = $x + $tileoffset[0];
            $ny = $y + $tileoffset[1];

            $neighbour = $this->neighbours->where('x', $nx)->where('y', $ny)->first();


            if (!is_null($neighbour)) {

//                echo "Found neighbour at $nx , $ny  edge  $localedge<br/>";
                $neighbourcount++;

                $neighbourelement = $neighbour->elementOnEdge($edge[0]);
                $localelement = $this->elementOnBaseTileEdge($localedge, $rotation);

                if (is_null($localelement) && is_null($neighbourelement)) {
                    // If there is no road / river, then Nothing matches with nothing
//                    echo "Both null<br/>";
                    continue;
                }

                if (is_null($localelement) || is_null($neighbourelement)) {
                    // If only one is null, then it clearly can't match.
//                    echo "null<br/>";
                    return false;
                }

                if($localelement->type != $neighbourelement->type){
                    // If the two types dont match, then return false.
//                    echo "Mismatch $localelement->type  with $neighbourelement->type didn't match $localedge to $edge[0] <br/>";
                    return false;
                }

//                echo "Matched $localelement->type  with $neighbourelement->type  on edge $localedge to $edge[0] <br/>";

            }

        }

        // Provided that we actually had a neighbour (e.g. can't place in the middle of nowhere!)
        return $neighbourcount > 0;

    }

    public function placeAt($x, $y, $rotation)
    {

        if (!is_null($this->user_id)) {
            throw new Exception('Tile already placed');
        }
        // Check that the tiles edges can fit.

        $this->place($x, $y, $rotation);

        $this->load('neighbours.elements.area');

        $this->connectEdges();

        $this->createAreasForOrphanedElements();

        return $this;

    }
    
    /**
     * Returns the available rotations if placing this tile at the given coordinate
     * @param $x
     * @param $y
     */
    public function availableRotationsAt($x, $y)
    {
        $results = array();
        $results['rotations'] = array();
        $results['url'] = $this->basetile->url();
        $results['id'] = $this->id;
        $results['x'] = $x;
        $results['y'] = $y;


        $this->x = $x;
        $this->y = $y;




        for($r = 0; $r < 360; $r += 90){
            $results['rotations'][$r] = $this->canBePlacedAt($x, $y, $r);
        }


        return $results;
    }
    
}
