<?php

declare(strict_types=1);

namespace AOC\Year2020\Day08;

use AOC\Util\CPU\CPU;
use AOC\Util\CPU\Event\BeforeExecuteInstruction;
use AOC\Util\Event\DefaultDispatcher;
use Generator;

class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $dispatcher = new DefaultDispatcher();
        $cpu = new CPU(['acc' => 0], $dispatcher);

        $cpu->addOpCode('nop', function (CPU $cpu) {
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('acc', function (CPU $cpu, array $args) {
            $cpu->incrementRegister('acc', (int) $args[0]);
            $cpu->incrementInstructionPointer();
        });

        $cpu->addOpCode('jmp', function (CPU $cpu, array $args) {
            $cpu->incrementInstructionPointer((int) $args[0]);
        });

        foreach ($input as $line) {
            $cpu->addInstruction($line);
        }

        $visitedInstructions = [];

        $dispatcher->addListener(BeforeExecuteInstruction::NAME, function (BeforeExecuteInstruction $event) use (&$visitedInstructions) {
            $ip = $event->cpu->getInstructionPointer();
            if (isset($visitedInstructions[$ip])) {
                // loop detected
                return false;
            }

            $visitedInstructions[$ip] = 1;

            return true;
        });

        $cpu->execute();

        return $cpu->readRegister('acc');
    }
}
