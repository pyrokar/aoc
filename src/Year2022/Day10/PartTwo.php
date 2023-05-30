<?php

declare(strict_types=1);

namespace AOC\Year2022\Day10;

use AOC\Util\Display2D;
use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        $display = new Display2D(40, 6);
        $currentX = 0;
        $currentY = 0;

        $x = 1;

        $addInstr = false;
        $value = 0;

        for ($cycle = 1; $cycle <= 240; $cycle++) {
            $spritePosition = [$x - 1, $x, $x + 1];

            if (in_array($currentX, $spritePosition, true)) {
                $display->set($currentX, $currentY);
            }

            $currentX = $cycle % 40;
            if (($cycle) % 40 === 0) {
                $currentY++;
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

        // echo $display;

        return PHP_EOL . $display;
    }
}
