<?php

declare(strict_types=1);

namespace AOC\Util;

use Generator;

/**
 * @template T
 */
class Set
{
    /**
     * @param List<T> $array
     */
    public function __construct(private array $array = [])
    {
    }

    /**
     * @param T $element
     *
     * @return void
     */
    public function addElement(mixed $element): void
    {
        $this->array[] = $element;
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return count($this->array);
    }

    /**
     * @param int $size
     * @param int $start
     * @param List<T> $partial
     *
     * @return Generator<int, List<T>>
     */
    public function getCombinationsOfSize(int $size, int $start = 0, array $partial = []): Generator
    {
        if ($size === 1) {
            foreach (array_slice($this->array, $start) as $el) {
                yield [...$partial, $el];
            }

            return;
        }

        $listLength = count($this->array);

        foreach (range($start, $listLength - $size) as $i) {
            yield from $this->getCombinationsOfSize($size - 1, $i + 1, [...$partial, $this->array[$i]]);
        }
    }

    /**
     * @return Generator<int, List<T>>
     */
    public function getCombinations(): Generator
    {
        $setSize = count($this->array);

        for ($size = 1; $size <= $setSize; ++$size) {
            yield from $this->getCombinationsOfSize($size);
        }
    }
}
