<?php

declare(strict_types=1);

namespace AOC\Year2019\Day07;

use AOC\Util\Set;
use AOC\Year2019\IntCodeComputer;

final class PartTwo
{
    /**
     * @param string $intcode
     *
     * @return int
     */
    public function __invoke(string $intcode): int
    {
        /** @var array<int, IntCodeComputer> $amps */
        $amps = [];

        for ($i = 0; $i < 5; ++$i) {
            $amps[$i] = IntCodeComputer::fromString($intcode);
        }

        $amps[4]->setHaltOnOutput(true);

        $max = 0;

        $phaseSetting = new Set(range(9, 5, -1));

        foreach ($phaseSetting->getPermutations() as $sequence) {

            foreach ($amps as $i => $amp) {
                $amp->reset();
                $amp->addInput($sequence[$i]);
            }

            $input = 0;

            while (true) {

                for ($i = 0; $i < 5; $i++) {
                    $amps[$i]->addInput($input);
                    $amps[$i]->execute();
                    $input = $amps[$i]->getLastOutput();
                }

                if ($amps[4]->hasFinished()) {
                    break;
                }
            }

            if ($input > $max) {
                $max = $input;
            }
        }

        return $max;
    }
}
