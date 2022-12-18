<?php

namespace AOC\Year2022\Day15;

use DomainException;

class Range2D
{
    public function __construct(
        public int $start,
        public int $end,
    )
    {
        assert($start <= $end);
    }

    public function canMerge(self $range2): bool
    {
        return ($this->start <= $range2->start && $this->end >= $range2->start - 1) || ($range2->start <= $this->start && $range2->end >= $this->start - 1);
    }

    public function merge(self $range2): void
    {
        if (!$this->canMerge($range2)) {
            throw new DomainException();
        }

        $this->start = min([$this->start, $range2->start]);
        $this->end = max([$this->end, $range2->end]);
    }

}
