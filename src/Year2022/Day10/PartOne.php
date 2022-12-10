<?php declare(strict_types=1);

namespace AOC\Year2022\Day10;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        $x = 1;

        $signalStrengths = [];
        $addInstr = false;
        $value = 0;

        for ($cycle = 1; $cycle <= 220; $cycle++) {
            if (($cycle + 20) % 40 === 0) {
                $signalStrengths[$cycle] = $cycle * $x;
            }

            if ($addInstr) {
                $x += $value;
                $addInstr = false;
                continue;
            }

            $instr = $input->current();
            $input->next();

            if (preg_match('/addx (?<value>-?\d+)/', $instr, $m)) {
                $value = (int) $m['value'];
                $addInstr = true;
            }
        }

        return array_sum($signalStrengths);
    }
}
