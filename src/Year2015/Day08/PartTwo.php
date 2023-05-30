<?php

declare(strict_types=1);

namespace AOC\Year2015\Day08;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_replace;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $all = [];

        foreach ($input as $line) {
            $length = strlen($line);

            $string = '"' . preg_replace([
                '/"/',
                '/\\\\/',
            ], [
                '_"',
                '__',
            ], $line) . '"';

            $all[] = strlen($string) - $length;
        }

        return array_sum($all);
    }
}
