<?php

declare(strict_types=1);

namespace AOC\Util\Event;

interface Event
{
    public function getName(): string;
}
