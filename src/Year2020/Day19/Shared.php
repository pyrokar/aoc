<?php

declare(strict_types=1);

namespace AOC\Year2020\Day19;

use AOC\Util\CachedCallableArray;
use Generator;

use function Safe\preg_match;

trait Shared
{
    /**
     * @param Generator<string> $input
     *
     * @return array{CachedCallableArray<int, string>, list<string>}
     */
    protected function processInput(Generator $input): array
    {
        $messages = [];

        /** @var CachedCallableArray<int, string> $rules */
        $rules = new CachedCallableArray();

        foreach ($input as $line) {
            if (preg_match('/(?<ruleNumber>\d+): "(?<char>\w)"$/', $line, $m)) {
                $rules->set((int)$m['ruleNumber'], fn() => $m['char']);
                continue;
            }

            if (preg_match('/(?<ruleNumber>\d+): (?<rule>[^|]*)$/', $line, $m)) {
                $parts = explode(' ', $m['rule']);
                $rules->set((int)$m['ruleNumber'], fn() => '(' . implode(array_map(static fn($r) => $rules->get((int)$r), $parts)) . ')');
                continue;
            }

            if (preg_match('/(?<ruleNumber>\d+): (?<rule>.*)$/', $line, $m)) {
                $parts = explode(' | ', $m['rule']);
                $rules->set(
                    (int)$m['ruleNumber'],
                    fn() => '(' .
                        implode(array_map(static fn($r) => $rules->get((int)$r), explode(' ', $parts[0]))) .
                        '|' .
                        implode(array_map(static fn($r) => $rules->get((int)$r), explode(' ', $parts[1]))) .
                        ')'
                );
                continue;
            }

            if (preg_match('/^[ab]+$/', $line)) {
                $messages[] = $line;
            }
        }

        return [$rules, $messages];
    }
}
