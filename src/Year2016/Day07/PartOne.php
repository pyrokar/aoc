<?php

declare(strict_types=1);

namespace AOC\Year2016\Day07;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    /**
     * @param string $ip
     *
     * @throws PcreException
     *
     * @return bool
     */
    public static function doesSupportTls(string $ip): bool
    {
        if (!preg_match('/([a-z])(?!\1)([a-z])\2\1/', $ip)) {
            // has no ABBA
            return false;
        }

        if (preg_match('/\[[^]]*([a-z])(?!\1)([a-z])\2\1/', $ip)) {
            // has ABBA between square brackets
            return false;
        }

        return true;
    }

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     *
     */
    public function __invoke(Generator $input): int
    {
        $count = 0;

        foreach ($input as $line) {
            if (self::doesSupportTls(trim($line))) {
                $count++;
            }
        }
        return $count;
    }
}
