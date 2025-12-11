<?php

declare(strict_types=1);

namespace AOC\Year2025\Day11;

use Generator;
use Safe\Exceptions\PcreException;

trait Shared
{
    /** @var array<string, int> */
    protected array $cache;

    /** @var array<string, list<string>> */
    protected array $matrix;

    /**
     * @param Generator $input
     *
     * @throws PcreException
     */
    public function init(Generator $input): void
    {
        $this->cache = [];
        $this->matrix = [];

        foreach ($input as $line) {
            if (!\Safe\preg_match('/^(?<s>.+): (?<t>.*)/', $line, $m)) {
                continue;
            }

            $source = $m['s'];
            $targets = explode(' ', $m['t']);

            $this->matrix[$source] = $targets;
        }
    }

    protected function findPaths(string $source, string $target): int
    {
        $cacheKey = $source . '_' . $target;
        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }

        $count = 0;

        foreach ($this->matrix[$source] as $otherTarget) {
            if ($otherTarget === $target) {
                $count++;
            } elseif ($otherTarget === 'out') {
                continue;
            } else {
                $count += $this->findPaths($otherTarget, $target);
            }
        }

        $this->cache[$cacheKey] = $count;

        return $count;
    }
}
