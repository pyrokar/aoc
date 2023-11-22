<?php

declare(strict_types=1);

namespace AOC\Year2022\Day20;

class Node
{
    public Node $next;
    public Node $prev;

    public function __construct(
        public int $number
    ) {}
}
