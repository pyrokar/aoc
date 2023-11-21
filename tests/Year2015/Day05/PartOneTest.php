<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day05;

use AOC\Year2015\Day05\PartOne;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('ugknbfddgicrmopn')], 1],
            [[$this->generatorFromString('aaa')], 1],
            [[$this->generatorFromString('jchzalrnumimnmhp')], 0],
            [[$this->generatorFromString('haegwjzuvuyypxyu')], 0],
            [[$this->generatorFromString('dvszwmarrgswjxmb')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 255],
        ];
    }
}
