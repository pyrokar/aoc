<?php

declare(strict_types=1);

namespace AOC\Util;

use ArrayAccess;
use Iterator;
use OutOfBoundsException;
use Override;

use function array_keys;

/**
 * @template TKey of (int | string)
 * @template TValue
 *
 * @implements ArrayAccess<TKey, TValue>
 * @implements Iterator<TKey, TValue>
 */
class CachedCallableArray implements ArrayAccess, Iterator
{
    private int $_position = 0;

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

    /**
     * @param TKey $offset
     *
     * @return bool
     */
    public function isset(mixed $offset): bool
    {
        return isset($this->array[$offset]);
    }

    public function resetCache(): void
    {
        $this->cache = [];
    }

    /**
     * @param TKey $offset
     *
     * @return bool
     */
    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->array[$offset]);
    }

    /**
     * @param TKey $offset
     *
     * @return TValue
     */
    #[Override]
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @param TKey $offset
     * @param TValue $value
     *
     * @return void
     */
    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->cache[$offset] = $value;
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        unset($this->array[$offset], $this->cache[$offset]);
    }

    /**
     * @return TValue
     */
    #[Override]
    public function current(): mixed
    {
        if (!$key = $this->key()) {
            throw new OutOfBoundsException();
        }

        return $this->get($key);
    }

    #[Override]
    public function next(): void
    {
        $this->_position++;
    }

    /**
     * @return TKey | null
     */
    #[Override]
    public function key(): int|string|null
    {
        return array_keys($this->array)[$this->_position] ?? null;
    }

    #[Override]
    public function valid(): bool
    {
        $key = $this->key();

        return $key && isset($this->array[$key]);
    }

    #[Override]
    public function rewind(): void
    {
        $this->_position = 0;
    }
}
