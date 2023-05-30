<?php

declare(strict_types=1);

namespace AOC\Year2015\Day14;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
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
        $max = 0;

        foreach ($input as $line) {

            if (!preg_match('#(?P<r>\w+) can fly (?P<speed>\d+) km/s for (?P<seconds>\d+) seconds, but then must rest for (?P<rest>\d+) seconds\.#', $line, $m)) {
                continue;
            }

            $speed = (int) $m['speed'];
            $secondsFlying = (int) $m['seconds'];
            $secondsRest = (int) $m['rest'];
            $distanceFlying = $speed * $secondsFlying;

            $cycle = $secondsFlying + $secondsRest;
            $distance = (int) floor($seconds / $cycle) * $distanceFlying;
            $remainder = $seconds & $cycle;

            if ($remainder < $secondsFlying) {
                $distance += $remainder * $speed;
            } else {
                $distance += $distanceFlying;
            }

            $max = max($max, $distance);
        }

        return $max;
    }
}
