<?php

declare(strict_types=1);

namespace AOC\Year2016\Day10;

use Generator;

class PartOne
{
    use Shared;

    /**
     * @param Generator $input
     * @param int $high
     * @param int $low
     *
     * @return int
     */
    public function __invoke(Generator $input, int $high, int $low): int
    {
        $this->init();
        $this->processInput($input);

        $this->executeInstructions();

        return $this->findBot($low, $high);
    }

    protected function findBot(int $low, int $high): int
    {
        foreach ($this->bots as $bot => $values) {
            [$botLow, $botHigh] = array_sort($values);

            if ($botLow === $low && $botHigh === $high) {
                return $bot;
            }
        }

        return -1;
    }
}
