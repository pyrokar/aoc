<?php

declare(strict_types=1);

namespace AOC\Year2022\Day25;

function snafuToDec(string $snafu): int
{
    static $map = [
        '2' => 2,
        '1' => 1,
        '0' => 0,
        '-' => -1,
        '=' => -2,
    ];

    $dec = 0;

    foreach (array_reverse(str_split($snafu)) as $i => $char) {
        $dec += $map[$char] * (5 ** $i);
    }

    return $dec;
}

function decToSnafu(int $dec): string
{
    static $map = [
        -2 => '1',
        -1 => '2',
        0 => '=',
        1 => '-',
        2 => '0',
        3 => '1',
        4 => '2'
    ];

    $snafu = '';
    $i = 1;

    while ($dec > 0) {
        $rest = ($dec - 3) % (5 ** $i++);
        $snafu .= $map[$rest % 5];
        $dec = intdiv($dec + 2, 5);
    }

    return strrev($snafu);
}
