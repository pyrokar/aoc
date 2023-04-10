<?php

declare(strict_types=1);

namespace AOC\Year2015\Day10;

use Generator;
use Safe\Exceptions\PcreException;
use function Safe\preg_match_all;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @param int $times
     *
     * @return int
     *
     * @throws PcreException
     */
    public function __invoke(Generator $input, int $times): int
    {
        $string = trim($input->current());

        $result = '';

        while (0 < $times--) {
            $result = '';
            preg_match_all('/(?P<m>(\d)\2*)/', $string, $m);

            $numbers = is_array($m['m']) ? $m['m'] : [$m['m']];

            foreach ($numbers as $number) {
                $result .= strlen($number).$number[0];
            }
            $string = $result;
        }

        return strlen($result);
    }
}
