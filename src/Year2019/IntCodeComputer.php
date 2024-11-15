<?php

declare(strict_types=1);

namespace AOC\Year2019;

use function array_map;
use function explode;
use function str_pad;
use function str_split;
use function AOC\Util\Safe\array_shift;

use const STR_PAD_LEFT;

class IntCodeComputer
{
    private int $instructionPointer = 0;

    /**
     * @var list<int>
     */
    private array $output = [];

    private bool $haltOnOutput = false;

    private bool $hasFinished = false;

    /**
     * @var list<int>
     */
    private array $initialMemory;

    /**
     * @param list<int> $memory
     * @param list<int> $input
     */
    public function __construct(
        private array $memory = [],
        private array $input = [0],
    ) {
        $this->initialMemory = $memory;
    }

    public static function fromString(string $input): IntCodeComputer
    {
        return new IntCodeComputer(self::parseMemory($input));
    }

    /**
     * @param string $input
     *
     * @return list<int>
     */
    public static function parseMemory(string $input): array
    {
        return array_map('intval', explode(',', $input));
    }

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

    public function reset(): void
    {
        $this->memory = $this->initialMemory;
        $this->instructionPointer = 0;
        $this->input = [];
        $this->output = [];
        $this->hasFinished = false;
    }

    /**
     * @return list<int>
     */
    public function getMemory(): array
    {
        return $this->memory;
    }

    /**
     * @param list<int> $input
     *
     * @return void
     */
    public function setInput(array $input): void
    {
        $this->input = $input;
    }

    public function addInput(int $input): void
    {
        $this->input[] = $input;
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

    public function setHaltOnOutput(bool $haltOnOutput): void
    {
        $this->haltOnOutput = $haltOnOutput;
    }

    public function hasFinished(): bool
    {
        return $this->hasFinished;
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
                $this->hasFinished = true;
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
                    if (count($this->input) === 0) {
                        break 2;
                    }
                    $this->memory[$this->memory[$this->instructionPointer + 1]] = array_shift($this->input);
                    $this->incrementInstructionPointer(2);
                    break;
                case 4:
                    $this->output[] = $value1;
                    $this->incrementInstructionPointer(2);
                    if ($this->haltOnOutput) {
                        break 2;
                    }
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
