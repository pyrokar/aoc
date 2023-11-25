<?php

declare(strict_types=1);

namespace AOC\Util;

/**
 * @template TKey of (int | string)
 * @template TValue
 */
class CachedCallableArray
{
    /**
     * @var array<TKey, callable(): TValue>
     */
    private array $array = [];

    /**
     * @var array<TKey, TValue>
     */
    private array $cache = [];

    /**
     * @param TKey $offset
     *
     * @return TValue
     */
    public function get(mixed $offset): mixed
    {
        if (!isset($this->cache[$offset])) {
            $this->cache[$offset] = $this->array[$offset]();
        }

        return $this->cache[$offset];
    }

    /**
     * @param TKey $offset
     * @param callable(): TValue $value
     *
     * @return void
     */
    public function set(mixed $offset, callable $value): void
    {
        $this->array[$offset] = $value;
    }

    /**
     * @param TKey $offset
     *
     * @return void
     */
    public function unset(mixed $offset): void
    {
        unset($this->array[$offset], $this->cache[$offset]);
    }

    public function resetCache(): void
    {
        $this->cache = [];
    }
}
