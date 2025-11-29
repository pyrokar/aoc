<?php

declare(strict_types=1);

namespace AOC\Year2019;

use function array_map;
use function array_slice;
use function explode;
use function implode;
use function str_pad;
use function str_split;
use function AOC\Util\Safe\array_shift;

use const STR_PAD_LEFT;

class IntCodeComputer
{
    use Debug;

    protected bool $debug = false;

    private int $instructionPointer = 0;

    /**
     * @var list<int>
     */
    private array $output = [];

    private bool $haltOnOutput = false;

    private bool $hasFinished = false;

    private int $relativeBase = 0;

    /**
     * @var array<int, int>
     */
    private array $initialMemory;

    /**
     * @param array<int, int> $memory
     * @param array<int> $input
     */
    public function __construct(
        private array $memory = [],
        private array $input = [],
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
        return array_map(intval(...), explode(',', $input));
    }

    /**
     * @param array<int, int> $memory
     *
     * @return void
     */
    public function setMemory(array $memory): void
    {
        $this->memory = $memory;
        $this->instructionPointer = 0;
    }

    public function setMemoryAt(int $addr, int $value): void
    {
        $this->memory[$addr] = $value;
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
     * @return array<int, int>
     */
    public function getMemory(): array
    {
        return $this->memory;
    }

    /**
     * @param array<int> $input
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

    /**
     * @return list<int>
     */
    public function consumeOutput(): array
    {
        $output = $this->output;
        $this->output = [];
        return $output;
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

    public function execute(): void
    {
        $this->_th();

        while (true) {
            $instruction = str_split(str_pad((string) $this->memory[$this->instructionPointer], 5, '0', STR_PAD_LEFT));

            $opcode = (int) ($instruction[3] . $instruction[4]);

            if ($opcode === 99) {
                $this->hasFinished = true;
                break;
            }

            $mod = implode('', array_slice($instruction, 0, 3));

            /** @var int<0, 2> $mode1 */
            $mode1 = (int) $instruction[2];
            /** @var int<0, 2> $mode2 */
            $mode2 = (int) $instruction[1];
            /** @var int<0, 2> $mode3 */
            $mode3 = (int) $instruction[0];

            $arg1 = $this->memory[$this->instructionPointer + 1] ?? 0;
            $arg2 = $this->memory[$this->instructionPointer + 2] ?? 0;
            $arg3 = $this->memory[$this->instructionPointer + 3] ?? 0;

            $addr1 = match ($mode1) {
                1 => -1,
                2 => $this->relativeBase + $arg1,
                default => $arg1,
            };

            $addr2 = match ($mode2) {
                1 => -1,
                2 => $this->relativeBase + $arg2,
                default => $arg2,
            };

            $addr3 = match ($mode3) {
                1 => -1,
                2 => $this->relativeBase + $arg3,
                default => $arg3,
            };

            $value1 = match ($mode1) {
                1 => $arg1,
                default => $this->memory[$addr1] ?? 0,
            };

            $value2 = match ($mode2) {
                1 => $arg2,
                default => $this->memory[$addr2] ?? 0,
            };

            switch ($opcode) {
                case 1:
                    $this->memory[$addr3] = $value1 + $value2;
                    $this->_td([
                        'mod' => $mod,'opc' => 'ADD',
                        'val1' => $value1, 'addr1' => $addr1,
                        'val2' => $value2, 'addr2' => $addr2,
                        'val3' => $this->memory[$addr3], 'addr3' => $addr3,
                    ]);
                    $this->incrementInstructionPointer(4);
                    break;
                case 2:
                    $this->memory[$addr3] = $value1 * $value2;
                    $this->_td([
                        'mod' => $mod, 'opc' => 'MUL',
                        'val1' => $value1, 'addr1' => $addr1,
                        'val2' => $value2, 'addr2' => $addr2,
                        'val3' => $this->memory[$addr3], 'addr3' => $addr3,
                    ]);
                    $this->incrementInstructionPointer(4);
                    break;
                case 3:
                    if (count($this->input) === 0) {
                        break 2;
                    }

                    $this->memory[$addr1] = array_shift($this->input);
                    $this->_td([
                        'mod' => $mod, 'opc' => 'INPUT',
                        'val1' => $this->memory[$arg1], 'addr1' => $addr1,
                    ]);
                    $this->incrementInstructionPointer(2);
                    break;
                case 4:
                    $this->output[] = $value1;
                    $this->_td([
                        'mod' => $mod, 'opc' => 'OUTPUT',
                        'val1' => $value1, 'addr1' => $addr1,
                    ]);
                    $this->incrementInstructionPointer(2);
                    if ($this->haltOnOutput) {
                        break 2;
                    }

                    break;
                case 5:
                    $this->_td([
                        'mod' => $mod, 'opc' => 'JMP !0',
                        'val1' => $value1, 'addr1' => $addr1,
                        'val2' => $value2, 'addr2' => $addr2,
                    ]);
                    if ($value1 !== 0) {
                        $this->setInstructionPointer($value2);
                    } else {
                        $this->incrementInstructionPointer(3);
                    }

                    break;
                case 6:
                    $this->_td([
                        'mod' => $mod, 'opc' => 'JMP =0',
                        'val1' => $value1, 'addr1' => $addr1,
                        'val2' => $value2, 'addr2' => $addr2,
                    ]);
                    if ($value1 === 0) {
                        $this->setInstructionPointer($value2);
                    } else {
                        $this->incrementInstructionPointer(3);
                    }

                    break;
                case 7:
                    if ($value1 < $value2) {
                        $this->memory[$addr3] = 1;
                    } else {
                        $this->memory[$addr3] = 0;
                    }

                    $this->_td([
                        'mod' => $mod, 'opc' => 'LT',
                        'val1' => $value1, 'addr1' => $addr1,
                        'val2' => $value2, 'addr2' => $addr2,
                        'val3' => $this->memory[$addr3], 'addr3' => $addr3,
                    ]);
                    $this->incrementInstructionPointer(4);
                    break;
                case 8:
                    if ($value1 === $value2) {
                        $this->memory[$addr3] = 1;
                    } else {
                        $this->memory[$addr3] = 0;
                    }

                    $this->_td([
                        'mod' => $mod, 'opc' => 'EQ',
                        'val1' => $value1, 'addr1' => $addr1,
                        'val2' => $value2, 'addr2' => $addr2,
                        'val3' => $this->memory[$addr3], 'addr3' => $addr3,
                    ]);

                    $this->incrementInstructionPointer(4);
                    break;
                case 9:
                    $this->relativeBase += $value1;
                    $this->_td([
                        'mod' => $mod, 'opc' => 'INC RB',
                        'val1' => $value1, 'addr1' => $addr1,
                    ]);
                    $this->incrementInstructionPointer(2);
                    break;
                default:
                    break 2;
            }
        }
    }

    private function incrementInstructionPointer(int $amount = 1): void
    {
        $this->instructionPointer += $amount;
    }

    private function setInstructionPointer(int $ip): void
    {
        $this->instructionPointer = $ip;
    }

}
