<?php

declare(strict_types=1);

namespace AOC\Year2015\Day07;

use AOC\Util\CachedCallableArray;
use Generator;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

trait Wires
{
    /** @var CachedCallableArray<string, int>  */
    private CachedCallableArray $wires;

    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     */
    private function wireInput(Generator $input): void
    {
        $this->wires = new CachedCallableArray();

        foreach ($input as $line) {
            if (preg_match('/^(?P<in_01>\d+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], static fn(): int => (int) $matches['in_01']);
            } elseif (preg_match('/^NOT (?P<in_01>[a-z]+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => ~(int) $this->wires->get($matches['in_01']));
            } elseif (preg_match('/^(?P<in_01>\d+) AND (?P<in_02>[a-z]+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => (int) $matches['in_01'] & $this->wires->get($matches['in_02']));
            } elseif (preg_match('/^(?P<in_01>[a-z]+) AND (?P<in_02>[a-z]+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => $this->wires->get($matches['in_01']) & $this->wires->get($matches['in_02']));
            } elseif (preg_match('/^(?P<in_01>[a-z]+) OR (?P<in_02>[a-z]+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => $this->wires->get($matches['in_01']) | $this->wires->get($matches['in_02']));
            } elseif (preg_match('/^(?P<in_01>[a-z]+) LSHIFT (?P<in_02>\d+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => ($this->wires->get($matches['in_01']) << (int) $matches['in_02']));
            } elseif (preg_match('/^(?P<in_01>[a-z]+) RSHIFT (?P<in_02>\d+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => $this->wires->get($matches['in_01']) >> (int) $matches['in_02']);
            } elseif (preg_match('/^(?P<in_01>[a-z]+) -> (?P<out>[a-z]+)/', $line, $matches)) {
                $this->wires->set($matches['out'], fn() => $this->wires->get($matches['in_01']));
            }
        }
    }
}
