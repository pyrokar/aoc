<?php

declare(strict_types=1);

namespace AOC\Year2024\Day19;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function str_replace;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $possibleDesigns = 0;

        $towelPatterns = '';

        foreach ($input as $i => $line) {
            if ($i === 0) {
                $towelPatterns = str_replace(', ', '|', $line);
                continue;
            }

            if (empty($line)) {
                continue;
            }

            if (preg_match('/^(' . $towelPatterns . ')+$/', $line)) {
                $possibleDesigns++;
            }
        }

        return $possibleDesigns;
    }
}
