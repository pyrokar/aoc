<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day06;

use AOC\Year2022\Day06\PartOne;
use AOCTest\Util\SolutionTestCase;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromString('mjqjpqmgbljsphdztnvjfqwrcgsmlb')], 7],
            [[$this->generatorFromString('bvwbjplbgvbhsrlpgdmjqwftvncz')], 5],
            [[$this->generatorFromString('nppdvjthqldpwncqszvftbrmjlhg')], 6],
            [[$this->generatorFromString('nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg')], 10],
            [[$this->generatorFromString('zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw')], 11],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1142],
        ];
    }
}
