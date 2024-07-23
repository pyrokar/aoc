<?php

declare(strict_types=1);

namespace AOC\Util\CPU;

use AOC\Util\CPU\Event\BeforeExecuteInstruction;
use AOC\Util\Event\DefaultDispatcher;
use AOC\Util\Event\Dispatcher;

class CPU
{
    /**
     * @var array<string, int>
     */
    private array $registers = [
        'a' => 0,
        'b' => 0,
        'c' => 0,
        'd' => 0,
    ];

    /**
     * @var array<string, callable>
     */
    private array $instructionSet = [];

    /**
     * @var list<Instruction>
     */
    private array $memory = [];

    /**
     * @var int also the program counter
     */
    private int $instructionPointer = 0;


    /**
     * @param array<string, int> $initRegisters
     */
    public function __construct(
        array $initRegisters = [],
        readonly private Dispatcher $eventDispatcher = new DefaultDispatcher(),
    ) {
        $this->registers = array_merge($this->registers, $initRegisters);
    }

    /**
     * @return Instruction[]
     */
    public function getMemory(): array
    {
        return $this->memory;
    }

    public function readRegister(string $register): int
    {
        return $this->registers[$register];
    }

    public function writeRegister(string $register, int $value): void
    {
        $this->registers[$register] = $value;
    }

    public function copyRegister(string $to, string $from): void
    {
        $this->registers[$to] = $this->registers[$from];
    }

    public function incrementRegister(string $register, int $value = 1): void
    {
        $this->registers[$register] += $value;
    }

    public function decrementRegister(string $register, int $value = 1): void
    {
        $this->registers[$register] -= $value;
    }

    public function addOpCode(string $opCode, callable $callback): void
    {
        $this->instructionSet[$opCode] = $callback;
    }

    public function incrementInstructionPointer(int $amount = 1): void
    {
        $this->instructionPointer += $amount;
    }

    public function getInstructionPointer(): int
    {
        return $this->instructionPointer;
    }

    public function addInstruction(Instruction | string $instruction): void
    {
        if (is_string($instruction)) {
            $this->memory[] = Instruction::fromString($instruction);
        } else {
            $this->memory[] = $instruction;
        }
    }

    /**
     * @param list<Instruction> $instructions
     *
     * @return void
     */
    public function setInstructions(array $instructions): void
    {
        $this->memory = $instructions;
    }

    public function execute(int $instructionPointer = 0): void
    {
        $this->instructionPointer = $instructionPointer;

        while (isset($this->memory[$this->instructionPointer])) {
            $instruction = $this->memory[$this->instructionPointer];

            if (!($this->eventDispatcher)(new BeforeExecuteInstruction($this, $instruction))) {
                return;
            }

            $this->instructionSet[$instruction->opCode]($this, $instruction->args);
        }
    }
}
