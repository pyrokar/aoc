<?php

declare(strict_types=1);

namespace AOC\Year2015\Day10;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match_all;

class PartOne
{
    /**
     * @param string $input
     * @param int $times
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(string $input, int $times): int
    {
        $result = '';

        while (0 < $times--) {
            $result = '';
            preg_match_all('/(?P<m>(\d)\2*)/', $input, $m);

            $numbers = is_array($m['m']) ? $m['m'] : [$m['m']];

            foreach ($numbers as $number) {
                $result .= strlen($number).$number[0];
            }
            $input = $result;
        }

        return strlen($result);
    }
}
