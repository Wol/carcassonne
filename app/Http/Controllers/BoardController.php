<?php

namespace App\Http\Controllers;

use App\GameTile;


class BoardController extends Controller
{

    public function rotationsat(GameTile $gametile, $x, $y)
    {
        return $gametile->availableRotationsAt($x, $y);
    }

    public function placetile(GameTile $gametile, $x, $y, $rotation)
    {

        $gametile->placeAt($x, $y, $rotation);

        $output = [];
        $output['tiles'] = [$gametile];
        $output['availableelements'] = $gametile->getAvailableMinionPlacementAreas();

        return $output;


    }

    public function placeminion(\App\GameAreaElement $gameareaelement, $miniontype)
    {


        $pl = $gameareaelement->tile->game->players()->first();

        $minion = $pl->minions()->unplaced()->type($miniontype)->first();

        $minion->placeOn($gameareaelement);

        $output = [];
        $output['minions'] = [$minion];

        return $output;

    }


}
