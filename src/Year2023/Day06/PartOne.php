<?php

declare(strict_types=1);

namespace AOC\Year2023\Day06;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\preg_replace;

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
        $times = [];
        $distances = [];

        $product = 1;

        foreach ($input as $line) {
            if (preg_match('/Time: (?<time>.*)/', preg_replace('/\s{2,}/', ' ', $line), $m)) {
                $times = explode(' ', $m['time']);
            }

            if (preg_match('/Distance: (?<distance>.*)/', preg_replace('/\s{2,}/', ' ', $line), $m)) {
                $distances = explode(' ', $m['distance']);
            }
        }

        foreach ($times as $i => $time) {
            $product *= $this->getOptions((int) $time, (int) $distances[$i]);
        }

        return $product;

    }

}
