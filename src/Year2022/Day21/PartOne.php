<?php

declare(strict_types=1);

namespace AOC\Year2022\Day21;

use Exception;
use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /** @var array<string, int | array<mixed>> */
    private array $monkeys;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     * @throws Exception
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->monkeys = [];

        foreach ($input as $line) {
            if (preg_match('/(?<monkey>\w+): (?<number>\d+)/', $line, $m)) {
                $this->monkeys[(string) $m['monkey']] = (int) $m['number'];
                continue;
            }

            if (preg_match('/(?<monkey>\w+): (?<left>\w+) (?<op>[+\-*\/]) (?<right>\w+)/', $line, $m)) {
                $this->monkeys[(string) $m['monkey']] = [$m['op'], $m['left'], $m['right']];
            }
        }

        return $this->calculate();
    }

    /**
     * @throws Exception
     */
    private function calculate(string $monkey = 'root'): int
    {
        if (is_int($this->monkeys[$monkey])) {
            return $this->monkeys[$monkey];
        }

        $operation = $this->monkeys[$monkey];
        return match ($operation[0]) {
            '+' => $this->calculate($operation[1]) + $this->calculate($operation[2]),
            '-' => $this->calculate($operation[1]) - $this->calculate($operation[2]),
            '*' => $this->calculate($operation[1]) * $this->calculate($operation[2]),
            '/' => $this->calculate($operation[1]) / $this->calculate($operation[2]),
            default => throw new Exception('Unexpected value'),
        };
    }

}
