<?php

declare(strict_types=1);

namespace AOC\Year2023\Day06;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\preg_replace;

class PartTwo
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
        $time = 0;
        $distance = 0;

        foreach ($input as $line) {
            if (preg_match('/Time: (?<time>.*)/', preg_replace('/\s{2,}/', ' ', $line), $m)) {
                $time = (int) preg_replace('/\s+/', '', $m['time']);
            }

            if (preg_match('/Distance: (?<distance>.*)/', preg_replace('/\s{2,}/', ' ', $line), $m)) {
                $distance = (int) preg_replace('/\s+/', '', $m['distance']);
            }
        }

        return $this->getOptions($time, $distance);
    }
}
