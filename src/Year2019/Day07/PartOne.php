<?php

declare(strict_types=1);

namespace AOC\Year2019\Day07;

use AOC\Util\Set;
use AOC\Year2019\IntCodeComputer;

final class PartOne
{
    /**
     * @param string $intcode
     *
     * @return int
     */
    public function __invoke(string $intcode): int
    {
        $amp = IntCodeComputer::fromString($intcode);

        $max = 0;

        $phaseSetting = new Set([0, 1, 2, 3, 4]);

        foreach ($phaseSetting->getPermutations() as $sequence) {

            $input = 0;

            for ($i = 0; $i < 5; $i++) {
                $amp->setInput([$sequence[$i], $input]);
                $amp->execute();
                $input = $amp->getLastOutput();
                $amp->reset();
            }

            if ($input > $max) {
                $max = $input;
            }
        }

        return $max;
    }
}
