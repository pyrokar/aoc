<?php declare(strict_types=1);

namespace AOC\Year2016\Day06;

use AOC\Util\SolutionInterface;
use AOC\Util\SolutionUtil;
use Generator;

class Solution implements SolutionInterface
{
    use SolutionUtil;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return string
     */
    public function solvePartOne(Generator $input): string
    {
        return $this->solve($input, 1);
    }

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return string
     */
    public function solvePartTwo(Generator $input): string
    {
        return $this->solve($input, 2);
    }

    /**
     * @param Generator<void, string, void, void> $input
     * @param int $part
     *
     * @return string
     */
    private function solve(Generator $input, int $part): string
    {
        $message = '';
        $columns = [];

        foreach ($input as $line) {
            $line = trim($line);

            foreach (str_split($line) as $column => $char) {
                if (!isset($columns[$column])) {
                    $columns[$column] = [];
                }

                if (!isset($columns[$column][$char])) {
                    $columns[$column][$char] = 0;
                }

                ++$columns[$column][$char];
            }
        }

        foreach ($columns as $charCounts) {
            $needle = $part === 1 ? max($charCounts) : min($charCounts);
            $message .= array_search($needle, $charCounts, true);
        }

        return $message;
    }
}
