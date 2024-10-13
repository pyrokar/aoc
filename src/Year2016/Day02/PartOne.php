<?php

declare(strict_types=1);

namespace AOC\Year2016\Day02;

use Generator;

class PartOne
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
            '1' => ['U' => '1', 'R' => '2', 'D' => '4', 'L' => '1'],
            '2' => ['U' => '2', 'R' => '3', 'D' => '5', 'L' => '1'],
            '3' => ['U' => '3', 'R' => '3', 'D' => '6', 'L' => '2'],
            '4' => ['U' => '1', 'R' => '5', 'D' => '7', 'L' => '4'],
            '5' => ['U' => '2', 'R' => '6', 'D' => '8', 'L' => '4'],
            '6' => ['U' => '3', 'R' => '6', 'D' => '9', 'L' => '5'],
            '7' => ['U' => '4', 'R' => '8', 'D' => '7', 'L' => '7'],
            '8' => ['U' => '5', 'R' => '9', 'D' => '8', 'L' => '7'],
            '9' => ['U' => '6', 'R' => '9', 'D' => '9', 'L' => '8'],
        ];

        return $this->solve($input, $keypad);
    }
}
