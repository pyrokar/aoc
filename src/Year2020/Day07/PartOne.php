<?php

declare(strict_types=1);

namespace AOC\Year2020\Day07;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
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
        $bags = [];

        foreach ($input as $line) {
            if (!preg_match('/(?<color>\w+ \w+) bags contain (?<contain>[^.]+)\./', $line, $m)) {
                continue;
            }

            $color = $m['color'];
            $containedBags = explode(', ', $m['contain']);

            foreach ($containedBags as $bag) {
                if (!preg_match('/\d+ (?<color>\w+ \w+) bags?/', $bag, $m)) {
                    continue;
                }

                $containedColor = (string) $m['color'];

                if (!isset($bags[$containedColor])) {
                    $bags[$containedColor] = [];
                }

                $bags[$containedColor][] = $color;
            }
        }

        $this->countBags('shiny gold', $bags, $containingBags);

        if (!$containingBags) {
            return 0;
        }

        return count($containingBags);
    }

    /**
     * @param string $color
     * @param array<string, list<string>> $bags
     * @param array<string, 1>|null $containingBags
     *
     * @return void
     */
    private function countBags(string $color, array $bags, ?array &$containingBags = []): void
    {
        if (!isset($bags[$color])) {
            return;
        }

        foreach ($bags[$color] as $containingColor) {
            $containingBags[$containingColor] = 1;
            $this->countBags($containingColor, $bags, $containingBags);
        }
    }
}
