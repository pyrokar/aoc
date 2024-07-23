<?php

declare(strict_types=1);

namespace AOC\Year2015\Day05;

use Generator;

use Safe\Exceptions\PcreException;

use function AOC\Util\reduceInputByLine;
use function Safe\preg_match;

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
        return reduceInputByLine($input, static function ($niceStrings, $line) {

            $pairTwoLetters = preg_match('/([a-z]{2}).*\1/', $line);

            $repeatingLetters = preg_match('/([a-z]).\1/', $line);

            return $niceStrings + (int) ($pairTwoLetters && $repeatingLetters);
        }, 0);
    }
}
