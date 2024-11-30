<?php

declare(strict_types=1);

namespace AOC\Year2023\Day07;

class PartTwo
{
    use Shared;

    #[\Override]
    protected function init(): void
    {
        $this->cardStrength = array_flip(['J', '2', '3', '4', '5', '6', '7', '8', '9', 'T', 'Q', 'K', 'A']);
        $this->typeStrength = array_flip(['hc', 'op', 'tp', 'three', 'fh', 'four', 'five']);
    }

    #[\Override]
    protected function getStrength(string $hand): int
    {
        $cardsCount = [];

        foreach (str_split($hand) as $card) {
            if (!isset($cardsCount[$card])) {
                $cardsCount[$card] = 0;
            }

            ++$cardsCount[$card];
        }

        $jokers = $cardsCount['J'] ?? 0;

        arsort($cardsCount);
        $cardsCount = array_values($cardsCount);

        if ($jokers === 4) {
            $cardsCount = [5];
        } elseif ($jokers === 3) {
            if ($cardsCount === [3, 1, 1]) {
                $cardsCount = [4, 1];
            } else { /* [3, 2] */
                $cardsCount = [5];
            }
        } elseif ($jokers === 2) {
            if ($cardsCount === [3, 2]) {
                $cardsCount = [5];
            } elseif ($cardsCount === [2, 2, 1]) {
                $cardsCount = [4, 1];
            } elseif ($cardsCount === [2, 1, 1, 1]) {
                $cardsCount = [3, 1, 1];
            }
        } elseif ($jokers === 1) {
            if ($cardsCount === [4, 1]) {
                $cardsCount = [5];
            } elseif ($cardsCount === [3, 1, 1]) {
                $cardsCount = [4, 1];
            } elseif ($cardsCount === [2, 2, 1]) {
                $cardsCount = [3, 2];
            } elseif ($cardsCount === [2, 1, 1, 1]) {
                $cardsCount = [3, 1, 1];
            } elseif ($cardsCount === [1, 1, 1, 1, 1]) {
                $cardsCount = [2, 1, 1, 1];
            }
        }

        return $this->getStrengthByCards($cardsCount, $hand);
    }
}
