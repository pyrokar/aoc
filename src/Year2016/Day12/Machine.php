<?php

declare(strict_types=1);

namespace AOC\Year2016\Day12;

use AOC\Util\CPU\CPU;
use Generator;

trait Machine
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param array<string, int> $initRegisters
     *
     * @return CPU
     */
    public function runMaschine(Generator $input, array $initRegisters = []): CPU
    {
        $cpu = new CPU($initRegisters);

        $cpu->addOpCode('cpy', function (CPU $cpu, array $args): void {
            if (!is_numeric($args[0])) {
                $cpu->copyRegister($args[1], $args[0]);
            } else {
                $cpu->writeRegister($args[1], (int) $args[0]);
            }
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('inc', function (CPU $cpu, array $args): void {
            $cpu->incrementRegister($args[0]);
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('dec', function (CPU $cpu, array $args): void {
            $cpu->decrementRegister($args[0]);
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('jnz', function (CPU $cpu, array $args): void {
            if (!is_numeric($args[0]) && $cpu->readRegister($args[0]) !== 0) {
                $cpu->incrementInstructionPointer((int) $args[1]);
            } elseif ((int) $args[0] !== 0) {
                $cpu->incrementInstructionPointer((int) $args[1]);
            } else {
                $cpu->incrementInstructionPointer();
            }
        });

        foreach ($input as $line) {
            $cpu->addInstruction(trim($line));
        }

        $cpu->execute();

        return $cpu;
    }
}
