<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day25;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use function AOC\Year2022\Day25\decToSnafu;
use function AOC\Year2022\Day25\snafuToDec;

class SnafuTest extends TestCase
{
    /**
     * @return list<array{string, int}>
     */
    public static function dataSnafuToDec(): array
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
     *
     * @param string $snafu
     * @param int $expectedDec
     *
     * @return void
     */
    #[DataProvider('dataSnafuToDec')]
    public function testSnafuToDec(string $snafu, int $expectedDec): void
    {
        self::assertEquals($expectedDec, snafuToDec($snafu));
    }

    /**
     * @return list<array{int, string}>
     */
    public static function dataDecToSnafu(): array
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
     *
     * @param int $dec
     * @param string $expectedSnafu
     *
     * @return void
     */
    #[DataProvider('dataDecToSnafu')]
    public function testDecToSnafu(int $dec, string $expectedSnafu): void
    {
        self::assertEquals($expectedSnafu, decToSnafu($dec));
    }

}
