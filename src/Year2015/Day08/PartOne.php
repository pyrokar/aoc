<?php
declare(strict_types=1);

namespace AOC\Year2015\Day08;

use Generator;
use Safe\Exceptions\PcreException;
use function Safe\preg_replace;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        $all = [];

        foreach ($input as $line) {
            $length = strlen($line);

            $string = preg_replace([
                '/^"(.*)"$/',
                '/\\\\\\\\/',
                '/\\\\"/',
                '/\\\\x[0-9a-f]{2}/',
            ], [
                '$1',
                '\\',
                '"',
                '_',
            ], $line);

            $all[] = $length - strlen($string);
        }

        return array_sum($all);
    }
}
