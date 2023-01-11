<?php

namespace AOCTest\Year2022\Day20;

use AOC\Year2022\Day20\Numbers;
use PHPUnit\Framework\TestCase;

class NumbersTest extends TestCase
{
    public function testMixOne(): void
    {
        $n = new Numbers([1, 2, -3, 3, -2, 0, 4]);

        $n->mix();

        $expected = [0, 3, -2, 1, 2, -3, 4];

        foreach ($expected as $i => $number) {
            self::assertEquals($number, $n->getNthNumber($i), 'Pos ' . $i);
        }
    }

    public function testMixTwo(): void
    {

        $n = new Numbers([811589153, 1623178306, -2434767459, 2434767459, -1623178306, 0, 3246356612]);

        $n->mix();

        $expected = [0, -2434767459, 3246356612, -1623178306, 2434767459, 1623178306, 811589153];

        foreach ($expected as $i => $number) {
            self::assertEquals($number, $n->getNthNumber($i), 'Pos ' . $i);
        }
    }
}
