<?php

namespace AOCTest\Year2022\Day25;

use PHPUnit\Framework\TestCase;
use function AOC\Year2022\Day25\decToSnafu;
use function AOC\Year2022\Day25\snafuToDec;

class SnafuTest extends TestCase
{
    public function dataSnafuToDec(): array
    {
        return [
            ['1=-0-2', 1747],
            ['12111', 906],
            ['2=0=', 198],
            ['21', 11],
            ['1=-1=', 353],
            ['1=11-2', 2022],
        ];
    }

    /**
     * @dataProvider dataSnafuToDec
     *
     * @param string $snafu
     * @param int $expectedDec
     * @return void
     */
    public function testSnafuToDec(string $snafu, int $expectedDec): void
    {
        self::assertEquals($expectedDec, snafuToDec($snafu));
    }

    public function dataDecToSnafu(): array
    {
        return [
            [1, '1'],
            [2, '2'],
            [3, '1='],
            [4, '1-'],
            [5, '10'],
            [8, '2='],
            [9, '2-'],
            [10, '20'],
            [15, '1=0'],
            [20, '1-0'],
            [2022, '1=11-2'],
            [12345, '1-0---0'],
            [314159265, '1121-1110-1=0'],
        ];
    }

    /**
     * @dataProvider dataDecToSnafu
     *
     * @param int $dec
     * @param string $expectedSnafu
     * @return void
     */
    public function testDecToSnafu(int $dec, string $expectedSnafu): void
    {
        self::assertEquals($expectedSnafu, decToSnafu($dec));
    }

}
