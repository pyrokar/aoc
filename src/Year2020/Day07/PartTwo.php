<?php

declare(strict_types=1);

namespace AOC\Year2020\Day07;

use AOC\Util\CachedCallableArray;
use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        /** @var CachedCallableArray<string, int> $bags */
        $bags = new CachedCallableArray();

        foreach ($input as $line) {
            if (!preg_match('/(?<color>\w+ \w+) bags contain (?<contain>[^.]+)\./', $line, $m)) {
                continue;
            }

            $color = $m['color'];

            if ($m['contain'] === 'no other bags') {
                $bags->set($color, fn(): int => 0);
                continue;
            }

            $containedBags = array_reduce(explode(', ', $m['contain']), function ($carry, $item) {
                if (!preg_match('/(?<number>\d+) (?<color>\w+ \w+) bags?/', $item, $m)) {
                    return $carry;
                }

                $carry[] = ['number' => (int) $m['number'], 'color' => $m['color']];
                return $carry;
            }, []);

            $bags->set($color, fn(): float|int => array_reduce($containedBags, static function ($carry, array $item) use ($bags): float|int {
                $carry += $item['number'] * ($bags->get($item['color']) + 1);
                return $carry;
            }, 0));
        }

        return $bags->get('shiny gold');
    }
}
