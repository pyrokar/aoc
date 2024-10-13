<?php

declare(strict_types=1);

namespace AOC\Year2022\Day11;

class Monkey
{
    public int $countInspections = 0;

    /**
     * @param array<ModuloNumber> $items
     * @param array<mixed> $operation
     * @param int $divisibleBy
     * @param int $trueToMonkey
     * @param int $falseToMonkey
     */
    public function __construct(
        public array            $items,
        private readonly array $operation,
        public readonly int    $divisibleBy,
        private readonly int    $trueToMonkey,
        private readonly int    $falseToMonkey,
    ) {}

    public function hasItems(): bool
    {
        return !empty($this->items);
    }

    /**
     * @param array<Monkey> $monkeys
     *
     * @return void
     */
    public function inspectAndThrowItem(array $monkeys): void
    {
        $this->countInspections++;

        $item = array_shift($this->items);

        if (!$item) {
            return;
        }

        switch ($this->operation[0]) {
            case 'square':
                $item->square();
                break;
            case 'add':
                $item->add($this->operation[1]);
                break;
            case 'mul':
                $item->mul($this->operation[1]);
                break;
        }

        if ($item->isDivisibleBy($this->divisibleBy)) {
            $monkeys[$this->trueToMonkey]->items[] = $item;
        } else {
            $monkeys[$this->falseToMonkey]->items[] = $item;
        }
    }
}
