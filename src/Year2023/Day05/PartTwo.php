<?php

declare(strict_types=1);

namespace AOC\Year2023\Day05;

use Generator;
use Safe\Exceptions\PcreException;

use DomainException;

use function Safe\preg_match;

class PartTwo
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
        /** @var list<int> $sourceRanges */
        $sourceRanges = [];

        foreach ($input as $line) {
            if (preg_match('/seeds: (?<seeds>.*)/', $line, $m)) {
                $seeds['seed'] = array_map(intval(...), explode(' ', $m['seeds']));
                continue;
            }

            if ($line === '') {
                if (!empty($sourceRanges) && $map) {
                    $seeds[$dest] = array_merge($seeds[$dest], $sourceRanges);
                }

                $map = false;
                continue;
            }

            if (preg_match('/(?<source>\w+)-to-(?<dest>\w+) map:/', $line, $m)) {
                $source = $m['source'];
                $dest = $m['dest'];
                $sourceRanges = $seeds[$source];
                $seeds[$dest] = [];
                $map = true;

                continue;
            }

            if (preg_match('/(?<dest>\d+) (?<source>\d+) (?<length>\d+)/', $line, $m)) {
                $rangeLength = (int) $m['length'];
                $destRangeStart = (int) $m['dest'];
                $srcRangeStart = (int) $m['source'];
                $srcRangeEnd = $srcRangeStart + $rangeLength - 1;

                $sourceRanges = array_values($sourceRanges);

                for ($i = 0, $l = count($sourceRanges); $i < $l; $i += 2) {
                    $rangeStart = $sourceRanges[$i];
                    $length = $sourceRanges[$i + 1];
                    $rangeEnd = $rangeStart + $length - 1;

                    if ($rangeStart > $srcRangeEnd || $rangeEnd < $srcRangeStart) {
                        continue;
                    }

                    // complete in range
                    if ($srcRangeStart <= $rangeStart && $rangeEnd <= $srcRangeEnd) {
                        $seeds[$dest][] = $rangeStart - $srcRangeStart + $destRangeStart;
                        $seeds[$dest][] = $length;
                        unset($sourceRanges[$i], $sourceRanges[$i + 1]);
                        continue;
                    }

                    if ($rangeStart < $srcRangeStart) {
                        // no mapping for left range
                        $sourceRanges[] = $rangeStart;
                        $sourceRanges[] = $srcRangeStart - $rangeStart;
                    }

                    if ($rangeEnd > $srcRangeEnd) {
                        // no mapping for right part
                        $sourceRanges[] = $srcRangeEnd + 1;
                        $sourceRanges[] = $rangeEnd - $srcRangeEnd;
                    }

                    if ($rangeStart < $srcRangeStart && $rangeEnd < $srcRangeEnd) {
                        $seeds[$dest][] = $destRangeStart;
                        $seeds[$dest][] = $rangeEnd - $srcRangeStart + 1;
                    }

                    if ($rangeStart > $srcRangeStart && $rangeEnd > $srcRangeEnd) {
                        $seeds[$dest][] = $rangeStart - $srcRangeStart + $destRangeStart;
                        $seeds[$dest][] = $srcRangeEnd - $rangeStart + 1;
                    }

                    unset($sourceRanges[$i], $sourceRanges[$i + 1]);
                }
            }
        }

        if (!empty($sourceRanges)) {
            $seeds[$dest] = array_merge($seeds[$dest], $sourceRanges);
        }

        $locations = [];

        foreach ($seeds['location'] as $k => $location) {
            if ($k % 2 === 0) {
                $locations[] = $location;
            }
        }

        if (empty($locations)) {
            throw new DomainException();
        }

        return min($locations);
    }
}
