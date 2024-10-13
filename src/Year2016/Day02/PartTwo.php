<?php

declare(strict_types=1);

namespace AOC\Year2016\Day02;

use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        /** @var array<string, array<string, string>> $keypad */
        $keypad = [
            '1' => ['U' => '1', 'R' => '1', 'D' => '3', 'L' => '1'],
            '2' => ['U' => '2', 'R' => '3', 'D' => '6', 'L' => '2'],
            '3' => ['U' => '1', 'R' => '4', 'D' => '7', 'L' => '2'],
            '4' => ['U' => '4', 'R' => '4', 'D' => '8', 'L' => '3'],
            '5' => ['U' => '5', 'R' => '6', 'D' => '5', 'L' => '5'],
            '6' => ['U' => '2', 'R' => '7', 'D' => 'A', 'L' => '5'],
            '7' => ['U' => '3', 'R' => '8', 'D' => 'B', 'L' => '6'],
            '8' => ['U' => '4', 'R' => '9', 'D' => 'C', 'L' => '7'],
            '9' => ['U' => '9', 'R' => '9', 'D' => '9', 'L' => '8'],
            'A' => ['U' => '6', 'R' => 'B', 'D' => 'A', 'L' => 'A'],
            'B' => ['U' => '7', 'R' => 'C', 'D' => 'D', 'L' => 'A'],
            'C' => ['U' => '8', 'R' => 'C', 'D' => 'C', 'L' => 'B'],
            'D' => ['U' => 'B', 'R' => 'D', 'D' => 'D', 'L' => 'D'],
        ];

        return $this->solve($input, $keypad);
    }
}
