<?php

use App\Tile;
use App\TileElement;
use Illuminate\Database\Seeder;


class TileTableSeeder extends Seeder
{
    public function run()
    {

//        DB::table("tiles")->truncate();

        $tile = new Tile();
        $tile->filename = "1_0_0.png";
        $tile->addElement(["road", [0.5, 0.5], TileElement::PathTop + TileElement::PathBottom]);
        $tile->addElement(["garden", [0.25, 0.3], TileElement::Standalone]);
        $tile->addElement(["field", [0.15, 0.85], TileElement::LeftHalf]);
        $tile->addElement(["field", [0.60, 0.70], TileElement::RightHalf]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_0_1.png";
        $tile->addElement(["road", [0.5, 0.85], TileElement::PathTop]);
        $tile->addElement(["road", [0.5, 0.15], TileElement::PathBottom]);
        $tile->addElement(["road", [0.85, 0.5], TileElement::PathRight]);
        $tile->addElement(["field", [0.2, 0.5], TileElement::LeftHalf]);
        $tile->addElement(["field", [0.8, 0.8], TileElement::TopRight + TileElement::RightTop]);
        $tile->addElement(["field", [0.8, 0.2], TileElement::BottomRight + TileElement::RightBottom]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_0_2.png";
        $tile->addElement(["road", [0.5, 0.75], TileElement::PathTop]);
        $tile->addElement(["monastery", [0.5, 0.5], TileElement::Standalone]);
        $tile->addElement(["field", [0.2, 0.2], TileElement::All]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_0_3.png";
        $tile->addElement(["field", [0.75, 0.75], TileElement::Top + TileElement::Right]);
        $tile->addElement(["city", [0.5, 0.2], TileElement::Bottom]);
        $tile->addElement(["city", [0.2, 0.5], TileElement::Left]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_1_0.png";
        $tile->addElement(["monastery", [0.5, 0.5], TileElement::Standalone]);
        $tile->addElement(["field", [0.75, 0.25], TileElement::All]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_1_1.png";
        $tile->addElement(["field", [0.25, 0.75], TileElement::TopHalf]);
        $tile->addElement(["field", [0.6, 0.4], TileElement::LeftBottom + TileElement::RightBottom]);
        $tile->addElement(["city", [0.5, 0.2], TileElement::Bottom]);
        $tile->addElement(["road", [0.3, 0.6], TileElement::PathLeft + TileElement::PathRight]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_1_2.png";
        $tile->addElement(["field", [0.25, 0.25], TileElement::Bottom + TileElement::Left]);
        $tile->addElement(["city", [0.75, 0.75], TileElement::Top + TileElement::Right]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_1_3.png";
        $tile->addElement(["monastery", [0.5, 0.5], TileElement::Standalone]);
        $tile->addElement(["field", [0.75, 0.25], TileElement::All]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_2_0.png";
        $tile->addElement(["road", [0.5, 0.5], TileElement::PathTop + TileElement::PathBottom]);
        $tile->addElement(["field", [0.2, 0.25], TileElement::LeftHalf]);
        $tile->addElement(["field", [0.75, 0.75], TileElement::RightHalf]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_2_1.png";
        $tile->addElement(["road", [0.5, 0.85], TileElement::PathTop]);
        $tile->addElement(["road", [0.5, 0.15], TileElement::PathBottom]);
        $tile->addElement(["road", [0.85, 0.5], TileElement::PathLeft]);
        $tile->addElement(["field", [0.8, 0.5], TileElement::RightHalf]);
        $tile->addElement(["field", [0.2, 0.8], TileElement::TopLeft + TileElement::LeftTop]);
        $tile->addElement(["field", [0.2, 0.2], TileElement::BottomLeft + TileElement::LeftBottom]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_2_2.png";
        $tile->addElement(["field", [0.3, 0.9], TileElement::TopLeft]);
        $tile->addElement(["field", [0.37, 0.9], TileElement::TopRight]);
        $tile->addElement(["city", [0.5, 0.3], TileElement::Bottom + TileElement::Right + TileElement::Left]);
        $tile->addElement(["road", [0.5, 0.8], TileElement::PathTop]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "1_2_3.png";
        $tile->addElement(["field", [0.1, 0.5], TileElement::Left]);
        $tile->addElement(["field", [0.85, 0.5], TileElement::Right]);
        $tile->addElement(["city", [0.4, 0.5], TileElement::Top + TileElement::Bottom]);
        $tile->save();

        // ======================= PAGE 2 ========================
        $tile = new Tile();
        $tile->filename = "2_0_0.png";
        $tile->addElement(["road", [0.5, 0.5], TileElement::PathTop + TileElement::PathBottom]);
        $tile->addElement(["field", [0.15, 0.85], TileElement::LeftHalf]);
        $tile->addElement(["field", [0.60, 0.70], TileElement::RightHalf]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_0_1.png";
        $tile->addElement(["road", [0.5, 0.85], TileElement::PathTop]);
        $tile->addElement(["road", [0.5, 0.15], TileElement::PathBottom]);
        $tile->addElement(["road", [0.85, 0.5], TileElement::PathRight]);
        $tile->addElement(["field", [0.2, 0.5], TileElement::LeftHalf]);
        $tile->addElement(["field", [0.8, 0.8], TileElement::TopRight + TileElement::RightTop]);
        $tile->addElement(["field", [0.8, 0.2], TileElement::BottomRight + TileElement::RightBottom]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_0_2.png";
        $tile->addElement(["road", [0.5, 0.75], TileElement::PathTop]);
        $tile->addElement(["monastery", [0.5, 0.5], TileElement::Standalone]);
        $tile->addElement(["field", [0.2, 0.2], TileElement::All]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_0_3.png";
        $tile->addElement(["field", [0.9, 0.4], TileElement::Top + TileElement::Right]);
        $tile->addElement(["city", [0.5, 0.2], TileElement::Bottom]);
        $tile->addElement(["city", [0.2, 0.5], TileElement::Left]);
        $tile->addElement(["garden", [0.6, 0.7], TileElement::Standalone]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_1_0.png";
        $tile->addElement(["monastery", [0.5, 0.5], TileElement::Standalone]);
        $tile->addElement(["field", [0.75, 0.25], TileElement::All]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_1_1.png";
        $tile->addElement(["field", [0.8, 0.8], TileElement::TopHalf]);
        $tile->addElement(["field", [0.6, 0.4], TileElement::LeftBottom + TileElement::RightBottom]);
        $tile->addElement(["city", [0.5, 0.2], TileElement::Bottom]);
        $tile->addElement(["road", [0.3, 0.55], TileElement::PathLeft + TileElement::PathRight]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_1_2.png";
        $tile->addElement(["field", [0.25, 0.25], TileElement::Bottom + TileElement::Left]);
        $tile->addElement(["city", [0.75, 0.75], TileElement::Top + TileElement::Right]);
        $tile->addElement(["garden", [0.25, 0.25], TileElement::Standalone]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_1_3.png";
        $tile->addElement(["monastery", [0.5, 0.5], TileElement::Standalone]);
        $tile->addElement(["field", [0.75, 0.25], TileElement::All]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_2_0.png";
        $tile->addElement(["road", [0.5, 0.5], TileElement::PathTop + TileElement::PathBottom]);
        $tile->addElement(["field", [0.2, 0.25], TileElement::LeftHalf]);
        $tile->addElement(["field", [0.75, 0.75], TileElement::RightHalf]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_2_1.png";
        $tile->addElement(["road", [0.5, 0.15], TileElement::PathTop]);
        $tile->addElement(["road", [0.5, 0.15], TileElement::PathBottom]);
        $tile->addElement(["road", [0.85, 0.5], TileElement::PathLeft]);
        $tile->addElement(["field", [0.8, 0.5], TileElement::RightHalf]);
        $tile->addElement(["field", [0.2, 0.8], TileElement::TopLeft + TileElement::LeftTop]);
        $tile->addElement(["field", [0.2, 0.2], TileElement::BottomLeft + TileElement::LeftBottom]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_2_2.png";
        $tile->addElement(["field", [0.3, 0.9], TileElement::TopLeft]);
        $tile->addElement(["field", [0.37, 0.9], TileElement::TopRight]);
        $tile->addElement(["city", [0.5, 0.3], TileElement::Bottom + TileElement::Right + TileElement::Left]);
        $tile->addElement(["road", [0.5, 0.8], TileElement::PathTop]);
        $tile->save();

        $tile = new Tile();
        $tile->filename = "2_2_3.png";
        $tile->addElement(["field", [0.1, 0.5], TileElement::Left]);
        $tile->addElement(["field", [0.85, 0.5], TileElement::Right]);
        $tile->addElement(["city", [0.4, 0.5], TileElement::Top + TileElement::Bottom]);
        $tile->save();


        // ====================== PAGE 3, 4, 5 =======================
        for($sheetno = 3; $sheetno <= 5; $sheetno ++) {

            $tile = new Tile();
            $tile->filename = $sheetno . "_0_0.png";
            $tile->addElement(["field", [0.25, 0.75], TileElement::LeftHalf | TileElement::TopHalf]);
            $tile->addElement(["field", [0.85, 0.5], TileElement::BottomRight + TileElement::RightBottom]);
            $tile->addElement(["road", [0.65, 0.35], TileElement::PathBottom + TileElement::PathRight]);
            if($sheetno == 5){
                $tile->addElement(["garden", [0.20, 0.75], TileElement::Standalone]);
            }
            $tile->save();


            $tile = new Tile();
            $tile->filename = $sheetno . "_0_1.png";
            $tile->addElement(["road", [0.5, 0.85], TileElement::PathTop]);
            $tile->addElement(["road", [0.5, 0.15], TileElement::PathBottom]);
            $tile->addElement(["road", [0.85, 0.5], TileElement::PathRight]);
            $tile->addElement(["field", [0.2, 0.5], TileElement::TopLeft + Tileelement::BottomLeft]);
            $tile->addElement(["field", [0.8, 0.8], TileElement::TopRight + TileElement::RightTop]);
            $tile->addElement(["field", [0.8, 0.2], TileElement::BottomRight + TileElement::RightBottom]);
            $tile->addElement(["city", [0.2, 0.5], TileElement::Left]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_0_2.png";
            $tile->addElement(["field", [0.25, 0.75], TileElement::TopLeft + TileElement::LeftTop]);
            $tile->addElement(["field", [0.7, 0.85], TileElement::LeftBottom + TileElement::TopRight]);
            $tile->addElement(["city", [0.5, 0.2], TileElement::Bottom + TileElement::Right]);
            $tile->addElement(["road", [0.3, 0.6], TileElement::PathLeft + TileElement::PathTop]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_0_3.png";
            $tile->addElement(["field", [0.25, 0.5], TileElement::Left]);
            $tile->addElement(["city", [0.6, 0.5], TileElement::Top + TileElement::Bottom + TileElement::Right]);
            if($sheetno == 5){
                $tile->addElement(["garden", [0.20, 0.5], TileElement::Standalone]);
            }
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_1_0.png";
            $tile->addElement(["road", [0.5, 0.5], TileElement::PathLeft + TileElement::PathBottom]);
            $tile->addElement(["field", [0.2, 0.25], TileElement::LeftBottom + TileElement::BottomLeft]);
            $tile->addElement(["field", [0.75, 0.75], TileElement::RightHalf | TileElement::TopHalf]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_1_1.png";
            $tile->addElement(["road", [0.5, 0.6], TileElement::PathLeft + TileElement::PathTop]);
            $tile->addElement(["field", [0.2, 0.75], TileElement::LeftTop + TileElement::TopLeft]);
            $tile->addElement(["field", [0.8, 0.45], TileElement::LeftBottom + TileElement::TopRight + TileElement::Right]);
            $tile->addElement(["city", [0.5, 0.25], TileElement::Bottom]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_1_2.png";
            $tile->addElement(["field", [0.25, 0.25], TileElement::Bottom + TileElement::Right]);
            $tile->addElement(["city", [0.75, 0.75], TileElement::Top + TileElement::Left]);
            if($sheetno == 3){
                $tile->addElement(["garden", [0.80, 0.35], TileElement::Standalone]);
            }
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_1_3.png";
            $tile->addElement(["field", [0.65, 0.5], TileElement::Bottom + TileElement::Right + TileElement::Top]);
            $tile->addElement(["city", [0.25, 0.5], TileElement::Left]);
            if($sheetno == 5){
                $tile->addElement(["garden", [0.55, 0.25], TileElement::Standalone]);
            }
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_2_0.png";
            $tile->addElement(["road", [0.5, 0.5], TileElement::PathRight + TileElement::PathBottom]);
            $tile->addElement(["field", [0.75, 0.25], TileElement::RightBottom + TileElement::BottomRight]);
            $tile->addElement(["field", [0.25, 0.75], TileElement::LeftHalf | TileElement::TopHalf]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_2_1.png";
            $tile->addElement(["road", [0.5, 0.5], TileElement::PathTop + TileElement::PathBottom]);
            $tile->addElement(["field", [0.2, 0.25], TileElement::LeftHalf]);
            $tile->addElement(["field", [0.75, 0.75], TileElement::RightHalf]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_2_2.png";
            $tile->addElement(["road", [0.5, 0.6], TileElement::PathRight + TileElement::PathTop]);
            $tile->addElement(["field", [0.75, 0.75], TileElement::RightTop + TileElement::TopRight]);
            $tile->addElement(["field", [0.2, 0.65], TileElement::RightBottom + TileElement::TopLeft + TileElement::Left]);
            $tile->addElement(["city", [0.5, 0.25], TileElement::Bottom]);
            $tile->save();

            $tile = new Tile();
            $tile->filename = $sheetno . "_2_3.png";
            $tile->addElement(["field", [0.8, 0.5], TileElement::Left + TileElement::Right]);
            $tile->addElement(["city", [0.5, 0.2], TileElement::Bottom]);
            $tile->addElement(["city", [0.5, 0.8], TileElement::Top]);
            if($sheetno == 3){
                $tile->addElement(["garden", [0.35, 0.5], TileElement::Standalone]);
            }
            $tile->save();
        }

    }
}
