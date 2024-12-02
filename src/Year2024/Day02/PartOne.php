<?php

declare(strict_types=1);

namespace AOC\Year2024\Day02;

use Generator;

use function array_map;
use function explode;

final class PartOne
{
    use Shared;
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $safeReports = 0;

        foreach ($input as $report) {
            $levels = array_map('intval', explode(' ', $report));

            if ($this->checkLevels($levels)) {
                $safeReports++;
            }

        }

        return $safeReports;
    }

}
