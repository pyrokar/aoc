<?php

declare(strict_types=1);

namespace AOC\Util;

class CachedCallableIntArray
{
    /**
     * @var array<string, callable(): int>
     */
    private array $array = [];

    /**
     * @var array<string, int>
     */
    private array $cache = [];

    /**
     * @param string $offset
     *
     * @return int
     */
    public function get(string $offset): int
    {
        if (!isset($this->cache[$offset])) {
            $this->cache[$offset] = $this->array[$offset]();
        }

        return $this->cache[$offset];
    }

    /**
     * @param string $offset
     * @param callable(): int $value
     *
     * @return void
     */
    public function set(string $offset, callable $value): void
    {
        $this->array[$offset] = $value;
    }

    public function unset(string $offset): void
    {
        unset($this->array[$offset], $this->cache[$offset]);
    }

    public function resetCache(): void
    {
        $this->cache = [];
    }
}
