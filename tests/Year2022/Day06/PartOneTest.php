<?php

declare(strict_types=1);

namespace AOCTest\Year2022\Day06;

use AOC\Year2022\Day06\PartOne;
use AOC\Test\Util\SolutionTest;

/**
 * @large
 */
class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [['mjqjpqmgbljsphdztnvjfqwrcgsmlb'], 7],
            [['bvwbjplbgvbhsrlpgdmjqwftvncz'], 5],
            [['nppdvjthqldpwncqszvftbrmjlhg'], 6],
            [['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg'], 10],
            [['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw'], 11],
            [['input'], 1142],
        ];
    }
}
