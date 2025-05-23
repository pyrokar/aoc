<?php

declare(strict_types=1);

namespace AOC\Util\Event;

use Override;

class DefaultDispatcher implements Dispatcher
{
    /**
     * @var array<string, list<callable>>
     */
    private array $listeners = [];

    #[Override]
    public function __invoke(Event $event): bool
    {
        if (!isset($this->listeners[$event->getName()])) {
            return true;
        }

        foreach ($this->listeners[$event->getName()] as $listener) {
            if (!$listener($event)) {
                return false;
            }
        }

        return true;
    }

    #[Override]
    public function addListener(string $eventName, callable $listener): void
    {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }

        $this->listeners[$eventName][] = $listener;
    }
}
