<?php

declare(strict_types=1);

namespace AOC\Year2020\Day02;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $validPasswords = 0;

        foreach ($input as $line) {
            if (!preg_match('/(?<from>\d+)-(?<to>\d+) (?<char>\D): (?<password>.*)/', $line, $m)) {
                continue;
            }

            $from = (int) $m['from'];
            $to = (int) $m['to'];
            $char = $m['char'];
            $password = $m['password'];

            $count = substr_count($password, $char);

            if ($count >= $from && $count <= $to) {
                $validPasswords++;
            }
        }

        return $validPasswords;
    }
}
