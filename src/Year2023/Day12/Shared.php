<?php

declare(strict_types=1);

namespace AOC\Year2023\Day12;

use Safe\Exceptions\PcreException;

use function implode;

trait Shared
{
    /** @var array<string, int> */
    private array $cache = [];

    /**
     * @param string $record
     * @param array<int> $list
     *
     * @throws PcreException
     *
     * @return int
     */
    protected function countArrangements(string $record, array $list): int
    {
        $cacheKey = $record . '_' . implode('_', $list);

        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }

        if ($record === '' && count($list) > 0) {
            return 0;
        }

        if (empty($list)) {
            if (empty($record) || !str_contains($record, '#')) {
                return 1;
            }

            return 0;
        }

        if (count($list) === 1 && \Safe\preg_match('/^[?#]{' . $list[0] . '}$/', $record)) {
            return 1;
        }

        $count = 0;

        $regex = '/^[?#]{' . $list[0] . '}[?.]/';
        if (\Safe\preg_match($regex, $record)) {
            $count += $this->countArrangements(substr($record, $list[0] + 1), array_slice($list, 1));
        }

        if (!str_starts_with($record, '#')) {
            $count += $this->countArrangements(substr($record, 1), $list);
        }

        $this->cache[$cacheKey] = $count;

        return $count;
    }
}
