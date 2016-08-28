<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tile extends Model {

    const Size = 200;

    protected $casts = ["elements" => "array"];


    static public function generateImage($x, $y, $sheet){

        $source = imagecreatefromjpeg("../resources/assets/images/Aligned/JPEG/Carcassonne Tiles " . $sheet . ".jpg");

        $tileimage = imagecreatetruecolor(Tile::Size, Tile::Size);

        $scansize = 1060;
        $scanspacing_x = 1296;
        $scanspacing_y = 1230;
        $margin = 100;
        $px = $margin + ($x * $scanspacing_x);
        $py = $margin + ($y * $scanspacing_y);

        imagecopyresampled($tileimage, $source, 0, 0, $px, $py, Tile::Size, Tile::Size, $scansize, $scansize);


        //header("Content-type: image/png");
        
        imagepng($tileimage, "../resources/assets/images/tiles/{$sheet}_{$x}_{$y}.png");

        imagedestroy($tileimage);

    }

    public function addElement($element){
        $_el = $this->elements;
        $_el[] = ['name' => $element[0], 'coordinate' => $element[1], 'connections' => $element[2]];
        $this->elements = $_el;
    }

    public function url(){
        return "/images/tiles/" . $this->filename;
    }
}