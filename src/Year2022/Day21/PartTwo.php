<?php declare(strict_types=1);

namespace AOC\Year2022\Day21;

use Generator;
use Safe\Exceptions\ArrayException;

class PartTwo
{
    private array $monkeys;
    private array $reverseLookup;

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     * @throws ArrayException
     */
    public function __invoke(Generator $input): int
    {
        $this->monkeys = [];
        $this->reverseLookup = [];

        foreach ($input as $line) {
            if (preg_match('/(?<monkey>\w+): (?<number>\d+)/', $line, $m)) {
                $this->monkeys[$m['monkey']] = (int)$m['number'];
                continue;
            }

            if (preg_match('/(?<monkey>\w+): (?<left>\w+) (?<op>[+\-*\/]) (?<right>\w+)/', $line, $m)) {
                $this->monkeys[$m['monkey']] = [$m['op'], $m['left'], $m['right']];

                $this->reverseLookup[$m['left']] = $m['monkey'];
                $this->reverseLookup[$m['right']] = $m['monkey'];
            }
        }

        $monkeyBeforeRoot = $this->findMonkeyBeforeRoot('humn');

        if ($this->monkeys['root'][1] === $monkeyBeforeRoot) {
            $otherSide = $this->calculate($this->monkeys['root'][2]);
        } else {
            $otherSide = $this->calculate($this->monkeys['root'][1]);
        }

        $this->monkeys['root'] = $otherSide;

        return $this->reverseCalculate();
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
                return ($this->calculate($operation[1]) / $this->calculate($operation[2]));
        }
    }

    private function reverseCalculate(string $monkey = 'humn'): int
    {

        $parent = $this->reverseLookup[$monkey];
        if (is_int($this->monkeys[$parent])) {
            return $this->monkeys[$parent];
        }

        $operation = $this->monkeys[$parent];

        if ($operation[1] === $monkey) {
            // humn is left side
            switch ($operation[0]) {
                case '+':
                    return $this->reverseCalculate($parent) - $this->calculate($operation[2]);
                case '-':
                    return $this->reverseCalculate($parent) + $this->calculate($operation[2]);
                case '*':
                    return $this->reverseCalculate($parent) / $this->calculate($operation[2]);
                case '/':
                    return $this->reverseCalculate($parent) * $this->calculate($operation[2]);
            }
        } elseif ($operation[2] === $monkey) {
            // humn is right side
            switch ($operation[0]) {
                case '+':
                    return $this->reverseCalculate($parent) - $this->calculate($operation[1]);
                case '-':
                    return $this->calculate($operation[1]) - $this->reverseCalculate($parent);
                case '*':
                    return $this->reverseCalculate($parent) / $this->calculate($operation[1]);
                case '/':
                    return $this->calculate($operation[1]) / $this->reverseCalculate($parent);
            }
        }

    }

    private function findMonkeyBeforeRoot(string $monkey): string
    {
        $parent = $this->reverseLookup[$monkey];

        if ($parent === 'root') {
            return $monkey;
        }

        return $this->findMonkeyBeforeRoot($parent);
    }
}
