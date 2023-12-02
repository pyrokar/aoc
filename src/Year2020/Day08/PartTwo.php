<?php

declare(strict_types=1);

namespace AOC\Year2020\Day08;

use AOC\Util\CPU\Instruction;
use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $gameConsole = new GameConsole();

        foreach ($input as $line) {
            $gameConsole->addInstruction(Instruction::fromString($line));
        }

        foreach ($gameConsole->getMemory() as $instruction) {
            if ($instruction->opCode === 'acc') {
                continue;
            }

            if ($instruction->opCode === 'nop') {
                $instruction->opCode = 'jmp';
            } elseif ($instruction->opCode === 'jmp') {
                $instruction->opCode = 'nop';
            }

            $gameConsole->run();

            if (!$gameConsole->hasLoop()) {
                return $gameConsole->getAcc();
            }

            if ($instruction->opCode === 'nop') {
                $instruction->opCode = 'jmp';
            } elseif ($instruction->opCode === 'jmp') {
                $instruction->opCode = 'nop';
            }
        }

        return 0;
    }
}
