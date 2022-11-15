<?php declare(strict_types=1);

namespace AOC\Year2016\Day02;

use Generator;

trait Shared
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param array<string, array<string, string>> $keypad
     *
     * @return string
     */
    protected function solve(Generator $input, array $keypad): string
    {
        $pos = '5';
        $code = '';

        foreach ($input as $line) {
            $dirs = str_split(trim($line));

            foreach ($dirs as $dir) {
                $pos = $keypad[$pos][$dir];
            }

            $code .= $pos;
        }

        return $code;
    }
}
