<?php

declare(strict_types=1);

namespace AOC\Year2015\Day15;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<string> $input
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

            $this->ingredients[$m['ingredient']] = [
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

            if ($this->calculateCalories($amounts) !== 500) {
                continue;
            }

            $maxScore = max($maxScore, $score);
        }

        return $maxScore;
    }

    /**
     * @param array<int, int> $amounts
     *
     * @return int
     */
    private function calculateCalories(array $amounts): int
    {
        $calories = 0;

        foreach (array_keys($this->ingredients) as $i => $ingredient) {
            $calories += $amounts[$i] * $this->ingredients[$ingredient]['calories'];
        }

        return $calories;
    }

}
