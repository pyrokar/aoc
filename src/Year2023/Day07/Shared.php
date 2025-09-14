<?php

declare(strict_types=1);

namespace AOC\Year2023\Day07;

use Generator;

trait Shared
{
    /**
     * @var array<string, int>
     */
    protected array $typeStrength;

    /**
     * @var array<int | string, int>
     */
    protected array $cardStrength;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init();

        $hands = [];

        foreach ($input as $line) {
            [$hand, $bid] = explode(' ', $line);

            $hands[$this->getStrength($hand)] = (int) $bid;
        }

        ksort($hands);

        $totalWinnings = 0;
        $i = 0;

        foreach ($hands as $bid) {
            $totalWinnings += ++$i * $bid;
        }

        return $totalWinnings;
    }

    /**
     * @param array<int> $cardsCount
     * @param string $hand
     *
     * @return int
     */
    protected function getStrengthByCards(array $cardsCount, string $hand): int
    {
        $type = 'hc';

        if ($cardsCount === [5]) {
            $type = 'five';
        } elseif ($cardsCount === [4, 1]) {
            $type = 'four';
        } elseif ($cardsCount === [3, 2]) {
            $type = 'fh';
        } elseif ($cardsCount === [3, 1, 1]) {
            $type = 'three';
        } elseif ($cardsCount === [2, 2, 1]) {
            $type = 'tp';
        } elseif ($cardsCount === [2, 1, 1, 1]) {
            $type = 'op';
        }

        $strength = (int) ($this->typeStrength[$type] * (13 ** 6));

        for ($i = 0; $i < 5; ++$i) {
            $strength += (int) ($this->cardStrength[$hand[$i]] * (13 ** (5 - $i)));
        }

        return $strength;
    }

    abstract protected function init(): void;

    abstract protected function getStrength(string $hand): int;
}
