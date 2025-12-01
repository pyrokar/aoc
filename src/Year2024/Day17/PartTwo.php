<?php

declare(strict_types=1);

namespace AOC\Year2024\Day17;

use function array_map;
use function explode;

final class PartTwo
{
    use Shared;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $this->program = array_map(intval(...), explode(',', $input));

        // TODO generic solution

        // trial and error
        $a
            = 0 * 8 ** 16
            + 4 * 8 ** 15
            + 5 * 8 ** 14
            + 2 * 8 ** 13
            + 6 * 8 ** 12
            + 4 * 8 ** 11
            + 4 * 8 ** 10
            + 5 * 8 ** 9
            + 1 * 8 ** 8
            + 3 * 8 ** 7
            + 3 * 8 ** 6
            + 2 * 8 ** 5
            + 6 * 8 ** 4
            + 7 * 8 ** 3
            + 2 * 8 ** 2
            + 7 * 8 ** 1
            + 5
        ;

        $this->reset($a);

        $output = [];

        while (($out = $this->run()) !== -1) {
            $output[] = $out;
        }

        if ($output === $this->program) {
            return $a;
        }

        return -1;
    }
}
