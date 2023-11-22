<?php

declare(strict_types=1);

namespace AOC\Year2015\Day15;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->ingredients = [];

        foreach ($input as $line) {
            if (!preg_match('#(?P<ingredient>\w+): capacity (?P<capacity>-?\d+), durability (?P<durability>-?\d+), flavor (?P<flavor>-?\d+), texture (?P<texture>-?\d+), calories (?P<calories>-?\d+)#', $line, $m)) {
                continue;
            }

            $this->ingredients[(string) $m['ingredient']] = [
                'capacity' => (int) $m['capacity'],
                'durability' => (int) $m['durability'],
                'flavor' => (int) $m['flavor'],
                'texture' => (int) $m['texture'],
                'calories' => (int) $m['calories'],
            ];
        }

        $maxScore = 0;

        foreach ($this->amounts(count($this->ingredients)) as $amounts) {
            $score = $this->calculateScore($amounts);

            $maxScore = max($maxScore, $score);
        }

        return $maxScore;
    }
}
