<?php

declare(strict_types=1);

namespace AOC\Year2024\Day24;

use AOC\Util\CachedCallableArray;
use Generator;
use Safe\Exceptions\PcreException;

use function bindec;
use function implode;
use function Safe\preg_match;
use function str_starts_with;

final class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $a = new CachedCallableArray();

        $zVars = [];

        foreach ($input as $line) {
            if (preg_match('/^(?<var>\w+): (?<value>\d)$/', $line, $m)) {
                $a->set($m['var'], static fn() => (int) $m['value']);
                continue;
            }

            if (preg_match('/^(?<in0>\w+) XOR (?<in1>\w+) -> (?<out>\w+)/', $line, $m)) {
                $a->set($m['out'], fn() => (int) $a->get($m['in0']) ^ (int) $a->get($m['in1']));
            } elseif (preg_match('/^(?<in0>\w+) AND (?<in1>\w+) -> (?<out>\w+)/', $line, $m)) {
                $a->set($m['out'], fn() => (int) $a->get($m['in0']) & (int) $a->get($m['in1']));
            } elseif (preg_match('/^(?<in0>\w+) OR (?<in1>\w+) -> (?<out>\w+)/', $line, $m)) {
                $a->set($m['out'], fn() => (int) $a->get($m['in0']) | (int) $a->get($m['in1']));
            }

            if (isset($m['out']) && str_starts_with($m['out'], 'z')) {
                $zVars[$m['out']] = 0;
            }
        }

        krsort($zVars);

        foreach ($zVars as $zVar => &$zValue) {
            $zValue = $a->get($zVar);
        }

        return (int) bindec(implode('', $zVars));
    }
}
