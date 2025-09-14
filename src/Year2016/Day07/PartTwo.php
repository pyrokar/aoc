<?php

declare(strict_types=1);

namespace AOC\Year2016\Day07;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\preg_match_all;
use function Safe\preg_replace;

class PartTwo
{
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
            if ($this->doesSupportSSL(trim($line))) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @throws PcreException
     */
    private function doesSupportSSL(string $ip): bool
    {
        // rearrange the ip, so that all hypernet parts are at the end

        preg_match_all('/\[(?<hypernet>\w+)/', $ip, $matches);

        $hypernet = implode('|', $matches['hypernet']);

        $notHypernet = preg_replace('/\[\w+]/', '|', $ip);

        $newIp = $notHypernet . '[' . $hypernet;

        if (preg_match('/([a-z])(?!\1)([a-z])\1.*\[.*\2\1\2/', $newIp)) {
            return true;
        }

        return false;
    }
}
