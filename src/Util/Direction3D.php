<?php

declare(strict_types=1);

namespace AOC\Util;

enum Direction3D: string
{
    case Up = 'u';
    case Down = 'd';
    case Forward = 'f';
    case Backward = 'b';
    case Left = 'l';
    case Right = 'r';
}
