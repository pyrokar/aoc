<?php

declare(strict_types=1);

namespace AOC\Year2015\Day14;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     * @param int $seconds
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input, int $seconds): int
    {
        $allReindeer = [];

        /** @var non-empty-array<string, int> $currentDistance */
        $currentDistance = [];

        /** @var non-empty-array<string, int> $points */
        $points = [];

        foreach ($input as $line) {

            if (!preg_match('#(?P<r>\w+) can fly (?P<speed>\d+) km/s for (?P<seconds>\d+) seconds, but then must rest for (?P<rest>\d+) seconds\.#', $line, $m)) {
                continue;
            }

            $reindeer = $m['r'];
            $speed = (int) $m['speed'];
            $flying = (int) $m['seconds'];
            $rest = (int) $m['rest'];

            $allReindeer[$reindeer] = [
                'speed' => $speed,
                'flying' => $flying,
                'rest' => $rest,
                'cycle' => $flying + $rest,
            ];

            $currentDistance[$reindeer] = $speed;
            $points[$reindeer] = 0;
        }

        foreach (max_value_keys($currentDistance) as $reindeer) {
            $points[$reindeer] = 1;
        }

        $second = 0;

        while (++$second < $seconds) {

            foreach ($allReindeer as $reindeer => $stats) {
                if ($second % $stats['cycle'] < $stats['flying']) {
                    // reindeer is flying
                    $currentDistance[$reindeer] += $stats['speed'];
                }
            }

            foreach (max_value_keys($currentDistance) as $reindeer) {
                ++$points[$reindeer];
            }
        }

        return max($points);
    }
}
