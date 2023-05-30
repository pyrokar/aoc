<?php

declare(strict_types=1);

namespace AOC\Util;

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
    private array $instractionSet = [];

    /**
     * @var array<array<mixed>>
     */
    private array $memory = [];

    private int $instructionPointer = 0;

    /**
     * @param array<string, int> $initRegisters
     */
    public function __construct(array $initRegisters = [])
    {
        $this->registers = array_merge($this->registers, $initRegisters);
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

    public function incrementRegister(string $register): void
    {
        $this->registers[$register]++;
    }

    public function decrementRegister(string $register): void
    {
        $this->registers[$register]--;
    }

    public function addOpCode(string $opCode, callable $callback): void
    {
        $this->instractionSet[$opCode] = $callback;
    }

    public function incrementInstructionPointer(int $amount = 1): void
    {
        $this->instructionPointer += $amount;
    }

    public function addInstruction(string $instruction): void
    {
        $arguments = explode(' ', $instruction);
        $opcode = array_shift($arguments);

        $this->memory[] = [$opcode, $arguments];
    }

    public function execute(int $instructionPointer = 0): void
    {
        $this->instructionPointer = $instructionPointer;

        while (isset($this->memory[$this->instructionPointer])) {
            $instruction = $this->memory[$this->instructionPointer];

            $this->instractionSet[$instruction[0]]($this, $instruction[1]);
        }
    }
}
