<?php

declare(strict_types=1);

namespace AOC\Year2020\Day08;

use AOC\Util\CPU\CPU;
use AOC\Util\CPU\Event\BeforeExecuteInstruction;
use AOC\Util\CPU\Instruction;
use AOC\Util\Event\DefaultDispatcher;

class GameConsole
{
    private readonly CPU $cpu;

    private bool $hasLoop = false;

    /**
     * @var array<int, int>
     */
    private array $visitedInstructions = [];

    public function __construct()
    {
        $dispatcher = new DefaultDispatcher();
        $this->cpu = new CPU(['acc' => 0], $dispatcher);

        $this->cpu->addOpCode('nop', function (CPU $cpu): void {
            $cpu->incrementInstructionPointer();
        });

        $this->cpu->addOpCode('acc', function (CPU $cpu, array $args): void {
            $cpu->incrementRegister('acc', (int) $args[0]);
            $cpu->incrementInstructionPointer();
        });

        $this->cpu->addOpCode('jmp', function (CPU $cpu, array $args): void {
            $cpu->incrementInstructionPointer((int) $args[0]);
        });

        $dispatcher->addListener(BeforeExecuteInstruction::NAME, function (BeforeExecuteInstruction $event): bool {
            $ip = $event->cpu->getInstructionPointer();
            if (isset($this->visitedInstructions[$ip])) {
                // loop detected
                $this->hasLoop = true;
                return false;
            }

            $this->visitedInstructions[$ip] = 1;

            return true;
        });
    }

    public function run(): void
    {
        $this->hasLoop = false;
        $this->visitedInstructions = [];
        $this->cpu->writeRegister('acc', 0);
        $this->cpu->execute();
    }

    public function hasLoop(): bool
    {
        return $this->hasLoop;
    }

    public function getAcc(): int
    {
        return $this->cpu->readRegister('acc');
    }

    /**
     * @return Instruction[]
     */
    public function getMemory(): array
    {
        return $this->cpu->getMemory();
    }

    public function addInstruction(Instruction $instruction): void
    {
        $this->cpu->addInstruction($instruction);
    }

}
