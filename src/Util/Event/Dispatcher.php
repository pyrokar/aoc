<?php

declare(strict_types=1);

namespace AOC\Util\Event;

interface Dispatcher
{
    public function __invoke(Event $event): bool;

    public function addListener(string $eventName, callable $listener): void;
}
