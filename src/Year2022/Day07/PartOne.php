<?php

declare(strict_types=1);

namespace AOC\Year2022\Day07;

use Generator;

use Safe\Exceptions\PcreException;

class PartOne
{
    use CalculateDirSize;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        $dirSizes = $this->calculateDirSize($input);

        foreach ($dirSizes as $dirSize) {
            if ($dirSize <= 100000) {
                $sum += $dirSize;
            }
        }

        return $sum;
    }
}
