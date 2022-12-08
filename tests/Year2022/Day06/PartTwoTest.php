<?php declare(strict_types=1);

namespace AOCTest\Year2022\Day06;

use AOC\Year2022\Day06\PartTwo;
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
            [['mjqjpqmgbljsphdztnvjfqwrcgsmlb'], 19],
            [['bvwbjplbgvbhsrlpgdmjqwftvncz'], 23],
            [['nppdvjthqldpwncqszvftbrmjlhg'], 23],
            [['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg'], 29],
            [['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw'], 26],
            [['input'], 2803],
        ];
    }
}
