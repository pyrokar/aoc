<?php

declare(strict_types=1);

namespace AOC\Year2024\Day19;

use Generator;
use Safe\Exceptions\PcreException;

use function explode;
use function Safe\preg_match;
use function str_replace;
use function str_starts_with;

final class PartTwo
{
    /** @var array<string, int> */
    private array $cache;

    /** @var array<string> */
    private array $towels;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $ways = 0;
        $this->towels = [];
        $this->cache = [];

        $towelPatterns = '';

        foreach ($input as $i => $line) {
            if ($i === 0) {
                $towelPatterns = str_replace(', ', '|', $line);
                $this->towels = explode(', ', $line);
                continue;
            }

            if (empty($line)) {
                continue;
            }

            if (!preg_match('/^(?<a>(' . $towelPatterns . ')+)$/', $line)) {
                continue;
            }

            $ways += $this->countWays($line);
        }

        return $ways;
    }

    private function countWays(string $design): int
    {
        if ($design === '') {
            return 1;
        }

        if (isset($this->cache[$design])) {
            return $this->cache[$design];
        }

        $ways = 0;

        foreach ($this->towels as $towel) {
            if (str_starts_with($design, $towel)) {
                $ways += $this->countWays(substr($design, strlen($towel)));
            }
        }

        $this->cache[$design] = $ways;

        return $ways;
    }
}
