<?php

declare(strict_types=1);

namespace AOC\Year2016\Day22;

use Generator;
use Safe\Exceptions\PcreException;

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
        $nodes = [];

        foreach ($input as $line) {
            if (\Safe\preg_match('#/dev/grid/node-x(?<x>\d+)-y(?<y>\d+)\s+(?<size>\d+)T\s+(?<used>\d+)T\s+(?<avail>\d+)T#', $line, $m)) {
                $nodes[] = [
                    'size' => (int) $m['size'],
                    'used' => (int) $m['used'],
                    'avail' => (int) $m['avail'],
                ];
            }
        }

        $pairs = 0;

        foreach ($nodes as $a => $A) {
            foreach ($nodes as $b => $B) {
                if ($a === $b) {
                    continue;
                }

                if ($A['used'] === 0) {
                    continue;
                }

                if ($A['used'] > $B['avail']) {
                    continue;
                }

                ++$pairs;
            }
        }

        return $pairs;
    }
}
