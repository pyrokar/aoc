<?php

declare(strict_types=1);

namespace AOC\Util;

use SplPriorityQueue;

/**
 * @template TPriority
 * @template TValue
 *
 * @extends SplPriorityQueue<TPriority, TValue>
 */
class PriorityQueueMin extends SplPriorityQueue
{
    /**
     * @param TPriority $priority1
     * @param TPriority $priority2
     *
     * @return int
     */
    public function compare(mixed $priority1, mixed $priority2): int
    {
        return parent::compare($priority2, $priority1);
    }

    /**
     * @return TValue
     */
    public function extract(): mixed
    {
        /** @phpstan-ignore-next-line */
        return parent::extract();
    }


}
