<?php

declare(strict_types=1);

namespace AOC\Year2019;

use function str_pad;
use function str_split;

use const STR_PAD_LEFT;

class IntCodeComputer
{
    private int $instructionPointer = 0;

    /**
     * @var list<int>
     */
    private array $output = [];

    /**
     * @param list<int> $memory
     * @param int $input
     */
    public function __construct(
        private array $memory = [],
        private readonly int   $input = 0,
    ) {}

    /**
     * @param list<int> $memory
     *
     * @return void
     */
    public function setMemory(array $memory): void
    {
        $this->memory = $memory;
        $this->instructionPointer = 0;
    }

    /**
     * @return list<int>
     */
    public function getMemory(): array
    {
        return $this->memory;
    }

    /**
     * @return list<int>
     */
    public function getOutput(): array
    {
        return $this->output;
    }

    public function getLastOutput(): int
    {
        return $this->output[count($this->output) - 1];
    }

    private function incrementInstructionPointer(int $amount = 1): void
    {
        $this->instructionPointer += $amount;
    }

    private function setInstructionPointer(int $ip): void
    {
        $this->instructionPointer = $ip;
    }

    public function execute(): void
    {
        while (true) {
            $instruction = str_split(str_pad((string) $this->memory[$this->instructionPointer], 5, '0', STR_PAD_LEFT));

            $opcode = (int) ($instruction[3] . $instruction[4]);

            if ($opcode === 99) {
                break;
            }

            $value1 = $instruction[2] === '0' ? $this->memory[$this->memory[$this->instructionPointer + 1]] : $this->memory[$this->instructionPointer + 1];
            $value2 = $instruction[1] === '0' && isset($this->memory[$this->memory[$this->instructionPointer + 2]]) ? $this->memory[$this->memory[$this->instructionPointer + 2]] : $this->memory[$this->instructionPointer + 2];

            switch ($opcode) {
                case 1:
                    $this->memory[$this->memory[$this->instructionPointer + 3]] = $value1 + $value2;
                    $this->incrementInstructionPointer(4);
                    break;
                case 2:
                    $this->memory[$this->memory[$this->instructionPointer + 3]] = $value1 * $value2;
                    $this->incrementInstructionPointer(4);
                    break;
                case 3:
                    $this->memory[$this->memory[$this->instructionPointer + 1]] = $this->input;
                    $this->incrementInstructionPointer(2);
                    break;
                case 4:
                    $this->output[] = $value1;
                    $this->incrementInstructionPointer(2);
                    break;
                case 5:
                    if ($value1 !== 0) {
                        $this->setInstructionPointer($value2);
                    } else {
                        $this->incrementInstructionPointer(3);
                    }
                    break;
                case 6:
                    if ($value1 === 0) {
                        $this->setInstructionPointer($value2);
                    } else {
                        $this->incrementInstructionPointer(3);
                    }
                    break;
                case 7:
                    if ($value1 < $value2) {
                        $this->memory[$this->memory[$this->instructionPointer + 3]] = 1;
                    } else {
                        $this->memory[$this->memory[$this->instructionPointer + 3]] = 0;
                    }
                    $this->incrementInstructionPointer(4);
                    break;
                case 8:
                    if ($value1 === $value2) {
                        $this->memory[$this->memory[$this->instructionPointer + 3]] = 1;
                    } else {
                        $this->memory[$this->memory[$this->instructionPointer + 3]] = 0;
                    }
                    $this->incrementInstructionPointer(4);
                    break;
                default:
                    break 2;
            }
        }
    }

}
