<?php declare(strict_types=1);

namespace AOC\Year2016\Day06;

use Generator;
use Safe\Exceptions\ArrayException;

trait Solution
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return string
     * @throws ArrayException
     */
    private function solve(Generator $input): string
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
            $needle = $this->getNeedle($charCounts);
            $message .= array_search($needle, $charCounts, true);
        }

        return $message;
    }

    abstract public function getNeedle(array $charCounts): int;
}
