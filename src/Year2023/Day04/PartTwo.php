<?php

declare(strict_types=1);

namespace AOC\Year2023\Day04;

use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\preg_replace;

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
        $cards = [];

        foreach ($input as $cardId => $line) {
            if (!preg_match('/Card \d+: (?<numbers>.*)/', preg_replace('/\s{2,}/', ' ', $line), $m)) {
                continue;
            }

            if (!isset($cards[$cardId])) {
                $cards[$cardId] = 0;
            }

            $cards[$cardId]++;

            [$w, $my] = explode(' | ', $m['numbers']);

            $win = explode(' ', $w);

            $my = explode(' ', $my);

            $matches = count(array_intersect($win, $my));

            for ($i = 0; $i < $matches; ++$i) {
                $id = $cardId + $i + 1;

                if (!isset($cards[$id])) {
                    $cards[$id] = 0;
                }

                $cards[$id] += $cards[$cardId];
            }
        }

        return array_sum($cards);
    }
}
