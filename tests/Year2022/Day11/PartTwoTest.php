<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day11;

use AOC\Year2022\Day11\ModuloNumber;
use AOC\Year2022\Day11\PartTwo;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
class PartTwoTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['test'], 2713310158],
            [['input'], 51382025916]
        ];
    }

    public function asdtestModulo(): void
    {
        $a = new ModuloNumber(50);
        $a->addDivisor(2);
        $a->add(4);

        self::assertTrue($a->isDivisibleBy(2));

        $b = new ModuloNumber(49);
        $b->addDivisor(7);
        $b->addDivisor(17);

        self::assertTrue($b->isDivisibleBy(7));

        $b->add(2);

        self::assertTrue($b->isDivisibleBy(17));

        $c = new ModuloNumber(5);
        $c->addDivisor(5);
        $c->addDivisor(7);
        $c->mul(7);

        self::assertTrue($c->isDivisibleBy(7));
    }
}
