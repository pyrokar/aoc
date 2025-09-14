<?php

declare(strict_types=1);

namespace AOC\Year2015\Day23;

use AOC\Util\CPU\CPU;
use Generator;

trait Solution
{
    /**
     * @param Generator<int, string> $input
     * @param string $register
     * @param array<string, int> $initRegisters
     *
     * @return int
     */
    public function getRegisterContent(Generator $input, string $register, array $initRegisters = []): int
    {
        $cpu = new CPU($initRegisters);

        $cpu->addOpCode('hlf', function (CPU $cpu, array $args): void {
            $register = $args[0];
            $cpu->writeRegister($register, $cpu->readRegister($register) / 2);
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('tpl', function (CPU $cpu, array $args): void {
            $register = $args[0];
            $cpu->writeRegister($register, $cpu->readRegister($register) * 3);
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('inc', function (CPU $cpu, array $args): void {
            $register = $args[0];
            $cpu->incrementRegister($register);
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('jmp', function (CPU $cpu, array $args): void {
            $offset = (int) $args[0];
            $cpu->incrementInstructionPointer($offset);
        });

        $cpu->addOpCode('jie', function (CPU $cpu, array $args): void {
            $register = $args[0];
            $offset = (int) $args[1];

            if ($cpu->readRegister($register) % 2 === 0) {
                $cpu->incrementInstructionPointer($offset);
            } else {
                $cpu->incrementInstructionPointer();
            }
        });

        $cpu->addOpCode('jio', function (CPU $cpu, array $args): void {
            $register = $args[0];
            $offset = (int) $args[1];

            if ($cpu->readRegister($register) === 1) {
                $cpu->incrementInstructionPointer($offset);
            } else {
                $cpu->incrementInstructionPointer();
            }
        });

        foreach ($input as $line) {
            $cpu->addInstruction(trim($line));
        }

        $cpu->execute();

        return $cpu->readRegister($register);
    }
}
