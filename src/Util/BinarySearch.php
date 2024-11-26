<?php

declare(strict_types=1);

namespace AOC\Util;

use Generator;

use function floor;

class BinarySearch
{
    private int $next;
    private bool $lower = true;

    public function __construct(
        private int $start,
        private int $end,
    ) {
        $this->next = (int) floor(($this->start + $this->end) / 2);
    }

    /**
     * @return Generator<int>
     */
    public function next(): Generator
    {
        while (true) {
            yield $this->next;

            if ($this->lower) {
                $this->end = $this->next;
            } else {
                $this->start = $this->next;
            }

            $newNext = (int) floor(($this->start + $this->end) / 2);

            if ($this->next === $newNext) {
                break;
            }

            $this->next = $newNext;

        }
    }

    public function setLower(bool $lower): void
    {
        $this->lower = $lower;
    }
}
