<?php

namespace AOC\Util;

use SplPriorityQueue;

class PriorityQueueMin extends SplPriorityQueue
{
    public function compare(mixed $priority1, mixed $priority2): int
    {
        return parent::compare($priority2, $priority1);
    }
}
