<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day06;

use AOC\Year2022\Day06\PartTwo;
use AOC\Test\Util\SolutionTest;

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
            [[$this->generatorFromString('mjqjpqmgbljsphdztnvjfqwrcgsmlb')], 19],
            [[$this->generatorFromString('bvwbjplbgvbhsrlpgdmjqwftvncz')], 23],
            [[$this->generatorFromString('nppdvjthqldpwncqszvftbrmjlhg')], 23],
            [[$this->generatorFromString('nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg')], 29],
            [[$this->generatorFromString('zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw')], 26],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 2803],
        ];
    }
}
