<?php

declare(strict_types=1);

namespace AOC\Year2024\Day07;

use AOC\Util\Set;
use Generator;

use function AOC\Util\Safe\array_shift;

final class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        /** @var Set<string> $operators */
        $operators = new Set(['+', '*']);

        return $this->calculateSum($input, $operators);
    }

    /**
     * @param non-empty-list<int> $numbers
     * @param array<string> $operators
     * @param int $value
     *
     * @return bool
     */
    protected function isValidEquation(array $numbers, array $operators, int $value): bool
    {
        $result = array_shift($numbers);

        foreach ($numbers as $i => $number) {
            $result = match ($operators[$i]) {
                '+' => $result + $number,
                '*' => $result * $number,
                default => $result,
            };

            if ($result > $value) {
                return false;
            }
        }

        return $result === $value;
    }

}
