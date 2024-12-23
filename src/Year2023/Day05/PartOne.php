<?php

declare(strict_types=1);

namespace AOC\Year2023\Day05;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
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
        $seeds = [];
        $dest = '';
        $map = false;
        $sourceNumbers = [];

        foreach ($input as $line) {
            if (preg_match('/seeds: (?<seeds>.*)/', $line, $m)) {
                $seeds['seed'] = explode(' ', $m['seeds']);
                continue;
            }

            if ($line === '') {
                if (!empty($sourceNumbers) && $map) {
                    $seeds[$dest] = array_merge($seeds[$dest], $sourceNumbers);
                }

                $map = false;
                continue;
            }

            if (preg_match('/(?<source>\w+)-to-(?<dest>\w+) map:/', $line, $m)) {
                $source = $m['source'];
                $dest = $m['dest'];
                $sourceNumbers = $seeds[$source];
                $seeds[$dest] = [];
                $map = true;

                continue;
            }

            if (preg_match('/(?<dest>\d+) (?<source>\d+) (?<length>\d+)/', $line, $m)) {
                $rangeLength = (int) $m['length'];
                $destRangeStart = (int) $m['dest'];
                $srcRangeStart = (int) $m['source'];
                $srcRangeEnd = $srcRangeStart + $rangeLength;

                foreach ($sourceNumbers as $i => $number) {
                    if ($srcRangeStart <= $number && $number < $srcRangeEnd) {
                        $seeds[$dest][] = $number - $srcRangeStart + $destRangeStart;
                        unset($sourceNumbers[$i]);
                    }
                }
            }
        }

        if (!empty($sourceNumbers)) {
            $seeds[$dest] = array_merge($seeds[$dest], $sourceNumbers);
        }

        return min($seeds['location']);
    }
}
