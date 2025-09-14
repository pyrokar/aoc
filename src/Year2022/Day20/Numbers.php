<?php

declare(strict_types=1);

namespace AOC\Year2022\Day20;

use Exception;

class Numbers
{
    public int $length = 0;

    /**
     * @var array<Node>
     */
    private array $list = [];
    private ?Node $head = null;
    private ?Node $tail = null;
    private ?Node $zero = null;

    /**
     * @param array<int> $numbers
     */
    public function __construct(array $numbers = [])
    {
        foreach ($numbers as $number) {
            $this->append($number);
        }
    }

    public function append(int $number): void
    {
        $n = new Node($number);

        if ($number === 0) {
            $this->zero = $n;
        }

        $this->list[] = $n;
        $this->length++;

        if (!$this->head || !$this->tail) {
            $this->head = $n;
            $this->tail = $n;
        } else {
            $n->prev = $this->tail;
            $n->next = $this->head;

            $this->tail->next = $n;
            $this->head->prev = $n;

            $this->tail = $n;
        }
    }

    public function mix(): void
    {
        foreach ($this->list as $node) {
            $this->move($node);
        }
    }

    public function move(Node $node): void
    {
        if ($node->number === 0) {
            return;
        }

        $move = $node->number;

        $move %= ($this->length - 1);

        // extract node
        $prev = $node->prev;
        $next = $node->next;

        $prev->next = $next;
        $next->prev = $prev;

        // search pos to insert
        if ($move > 0) {
            for ($i = 1; $i < $move; $i++) {
                $next = $next->next;
            }
        } else {
            for ($i = 0; $i >= $move; $i--) {
                $next = $next->prev;
            }
        }

        $prev = $next;
        $next = $prev->next;

        // insert
        $prev->next = $node;
        $next->prev = $node;
        $node->next = $next;
        $node->prev = $prev;
    }

    /**
     * @throws Exception
     */
    public function getNthNumber(int $n): int
    {
        if (!$this->zero) {
            throw new Exception();
        }

        $node = $this->zero;
        for ($i = 0; $i < $n; $i++) {
            $node = $node->next;
        }

        return $node->number;
    }

    public function print(): void
    {
        $pos = $this->head;

        if (!$pos) {
            echo '--empty--' . PHP_EOL;
            return;
        }

        do {
            echo $pos->number . PHP_EOL;
            $pos = $pos->next;
        } while ($pos !== $this->head);
    }
}
