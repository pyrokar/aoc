<?php

declare(strict_types=1);

namespace AOC\Year2023\Day12;

use Generator;
use Safe\Exceptions\PcreException;

use function array_map;
use function explode;

class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $arrangementsCount = 0;

        foreach ($input as $line) {
            [$record, $list] = explode(' ', $line);

            $list = array_map(intval(...), explode(',', $list));

            $arrangementsCount += $this->countArrangements($record, $list);
        }

        return $arrangementsCount;
    }

}
