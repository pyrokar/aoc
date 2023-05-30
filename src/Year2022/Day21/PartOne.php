<?php

declare(strict_types=1);

namespace AOC\Year2022\Day21;

use Generator;

class PartOne
{
    private array $monkeys;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->monkeys = [];

        foreach ($input as $line) {
            if (preg_match('/(?<monkey>\w+): (?<number>\d+)/', $line, $m)) {
                $this->monkeys[$m['monkey']] = (int) $m['number'];
                continue;
            }

            if (preg_match('/(?<monkey>\w+): (?<left>\w+) (?<op>[+\-*\/]) (?<right>\w+)/', $line, $m)) {
                $this->monkeys[$m['monkey']] = [$m['op'], $m['left'], $m['right']];
            }
        }

        return $this->calculate();
    }

    private function calculate(string $monkey = 'root'): int
    {
        if (is_int($this->monkeys[$monkey])) {
            return $this->monkeys[$monkey];
        }

        $operation = $this->monkeys[$monkey];
        switch ($operation[0]) {
            case '+':
                return $this->calculate($operation[1]) + $this->calculate($operation[2]);
            case '-':
                return $this->calculate($operation[1]) - $this->calculate($operation[2]);
            case '*':
                return $this->calculate($operation[1]) * $this->calculate($operation[2]);
            case '/':
                return $this->calculate($operation[1]) / $this->calculate($operation[2]);
        }
    }

}
