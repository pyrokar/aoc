<?php

declare(strict_types=1);

namespace AOC\Year2024\Day17;

trait Shared
{
    protected int $ip;

    /** @var array<string, int> */
    protected array $registers;

    /** @var array<int> */
    protected array $program;

    protected function run(): int
    {
        while (isset($this->program[$this->ip])) {
            $opcode = $this->program[$this->ip];
            $operand = $this->program[$this->ip + 1];

            switch ($opcode) {
                case 0:
                    // adv
                    $this->registers['A'] = (int) ($this->registers['A'] / (2 ** $this->getValueFromComboOperand($operand)));
                    $this->ip += 2;
                    break;
                case 1:
                    // bxl
                    $this->registers['B'] ^= $operand;
                    $this->ip += 2;
                    break;
                case 2:
                    // bst
                    $this->registers['B'] = ($this->getValueFromComboOperand($operand) % 8); //& 0b111;
                    $this->ip += 2;
                    break;
                case 3:
                    //jnz
                    if ($this->registers['A'] === 0) {
                        $this->ip += 2;
                    } else {
                        $this->ip = $operand;
                    }

                    break;
                case 4:
                    // bxc
                    $this->registers['B'] ^= $this->registers['C'];
                    $this->ip += 2;
                    break;
                case 5:
                    // out
                    $this->ip += 2;
                    return $this->getValueFromComboOperand($operand) % 8;
                case 6:
                    // bdv
                    $this->registers['B'] = (int) ($this->registers['A'] / (2 ** $this->getValueFromComboOperand($operand)));
                    $this->ip += 2;
                    break;
                case 7:
                    // cdv
                    $this->registers['C'] = (int) ($this->registers['A'] / (2 ** $this->getValueFromComboOperand($operand)));
                    $this->ip += 2;
                    break;
            }
        }

        return -1;
    }

    protected function reset(int $a): void
    {
        $this->ip = 0;
        $this->registers = ['A' => $a, 'B' => 0, 'C' => 0];
    }

    protected function getValueFromComboOperand(int $operand): int
    {
        if ($operand < 4) {
            return $operand;
        }

        return match ($operand) {
            4 => $this->registers['A'],
            5 => $this->registers['B'],
            6 => $this->registers['C'],
            default => -1,
        };
    }
}
