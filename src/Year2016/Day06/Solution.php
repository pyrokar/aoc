<?php

declare(strict_types=1);

namespace AOC\Year2016\Day06;

use Generator;
use Safe\Exceptions\ArrayException;

use function array_values;

trait Solution
{
    abstract public function getNeedle(array $charCounts): int;
    /**
     * @param Generator<void, non-empty-string, void, void> $input
     *
     * @throws ArrayException
     *
     * @return string
     */
    private function solve(Generator $input): string
    {
        $message = '';

        /** @var non-empty-array<int, non-empty-array<numeric-string, int>> $columns */
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
            if (empty($charCounts)) {
                continue;
            }

            $needle = $this->getNeedle(array_values($charCounts));
            $message .= array_search($needle, $charCounts, true);
        }

        return $message;
    }
}
