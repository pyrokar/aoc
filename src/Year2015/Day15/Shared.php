<?php
declare(strict_types=1);

namespace AOC\Year2015\Day15;

use Generator;

trait Shared
{
    protected array $ingredients;

    /**
     * @param int $dimensions
     * @return Generator<int, array<int>, void, void>
     */
    protected function amounts(int $dimensions): Generator
    {
        if ($dimensions === 2) {
            for ($i = 1; $i < 100; $i++) {
                yield [$i, 100 - $i];
            }
        } elseif ($dimensions === 4) {
            for ($i = 1; $i < 100; $i++) {
                for ($j = 1; $j < 100; $j++) {
                    for ($k = 1; $k < 100; $k++) {
                        $sum = $i + $j + $k;
                        if ($sum > 99) {
                            continue;
                        }

                        yield [$i, $j, $k, 100 - $sum];
                    }
                }
            }
        }
    }

    /**
     * @param array<int> $amounts
     * @return int
     */
    protected function calculateScore(array $amounts): int
    {
        $score = 1;

        foreach (['capacity', 'durability', 'flavor', 'texture'] as $property) {
            $ingredientScore = 0;

            foreach (array_keys($this->ingredients) as $i => $ingredient) {
                $ingredientScore += $amounts[$i] * $this->ingredients[$ingredient][$property];
            }

            if ($ingredientScore <= 0) {
                $score *= 0;
            } else {
                $score *= $ingredientScore;
            }
        }

        return $score;
    }
}
