<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class TileElement
{

    // Definitions for a tileelement location
    const Standalone = 0;

    const TopLeft = 1; // Top border, left hand side
    const PathTop = 2;
    const TopRight = 4; // Top border, right hand side
    const RightTop = 8; // Right border, top half
    const PathRight = 16;
    const RightBottom = 32; // Right border, bottom half
    const BottomRight = 64;
    const PathBottom = 128;
    const BottomLeft = 256;
    const LeftBottom = 512;
    const PathLeft = 1024;
    const LeftTop = 2048;

    const Top = self::TopLeft + self::TopRight;
    const Right = self::RightTop + self::RightBottom;
    const Bottom = self::BottomRight + self::BottomLeft;
    const Left = self::LeftBottom + self::LeftTop;

    const TopHalf = self::Top + self::RightTop + self::LeftTop;
    const RightHalf = self::Right + self::TopRight + self::BottomRight;
    const BottomHalf = self::Bottom + self::RightBottom + self::LeftBottom;
    const LeftHalf = self::Left + self::TopLeft + self::BottomLeft;


    const All = self::Top + self::Right + self::Bottom + self::Left;


    const neighbours = [
        self::TopLeft => [self::BottomLeft, [0, 1]],
        self::PathTop => [self::PathBottom, [0, 1]],
        self::TopRight => [self::BottomRight, [0, 1]],

        self::RightTop => [self::LeftTop, [1, 0]],
        self::PathRight => [self::PathLeft, [1, 0]],
        self::RightBottom => [self::LeftBottom, [1, 0]],

        self::BottomRight => [self::TopRight, [0, -1]],
        self::PathBottom => [self::PathTop, [0, -1]],
        self::BottomLeft => [self::TopLeft, [0, -1]],

        self::LeftBottom => [self::RightBottom, [-1, 0]],
        self::PathLeft => [self::PathRight, [-1, 0]],
        self::LeftTop => [self::RightTop, [-1, 0]],
    ];

}