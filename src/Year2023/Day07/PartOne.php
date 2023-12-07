<?php

declare(strict_types=1);

namespace AOC\Year2023\Day07;

class PartOne
{
    use Shared;

    protected function init(): void
    {
        $this->cardStrength = array_flip(['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A']);
        $this->typeStrength = array_flip(['hc', 'op', 'tp', 'three', 'fh', 'four', 'five']);
    }

    protected function getStrength(string $hand): int
    {
        $cardsCount = [];

        foreach (str_split($hand) as $card) {
            if (!isset($cardsCount[$card])) {
                $cardsCount[$card] = 0;
            }

            ++$cardsCount[$card];
        }

        arsort($cardsCount);

        $cardsCount = array_values($cardsCount);

        return $this->getStrengthByCards($cardsCount, $hand);
    }
}
