<?php

declare(strict_types=1);

namespace AOC\Year2022\Day11;

use Generator;
use Safe\Exceptions\JsonException;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\json_decode;

trait Util
{
    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     * @throws JsonException
     *
     * @return array<Monkey>
     */
    private function inputToMonkeys(Generator $input): array
    {
        $monkeys = [];

        $monkeyData = ['items' => [], 'op' => [], 'divisibleBy' => 1, 'trueToMonkey' => 0, 'falseToMonkey' => 0];

        foreach ($input as $line) {
            if ($line === '') {
                $monkeys[] = new Monkey(
                    $monkeyData['items'],
                    $monkeyData['op'],
                    $monkeyData['divisibleBy'],
                    $monkeyData['trueToMonkey'],
                    $monkeyData['falseToMonkey'],
                );
                continue;
            }

            if (preg_match('/Monkey \d+:/', $line)) {
                $monkeyData = ['items' => [], 'op' => [], 'divisibleBy' => 1, 'trueToMonkey' => 0, 'falseToMonkey' => 0];
                continue;
            }

            if (preg_match('/Starting items: (?<items>.*)/', $line, $m)) {
                /** @var list<int> $items */
                $items = json_decode('[' . $m['items'] . ']', true, 512, JSON_THROW_ON_ERROR);
                $monkeyData['items'] = array_map(static fn(int $i) => new ModuloNumber($i), $items);

                continue;
            }

            if (preg_match('/Operation: new = old \* old/', $line, $m)) {
                $monkeyData['op'] = ['square'];
                continue;
            }

            if (preg_match('/Operation: new = old \+ (?<n>\d+)/', $line, $m)) {
                $monkeyData['op'] = ['add', (int) $m['n']];
                continue;
            }

            if (preg_match('/Operation: new = old \* (?<n>\d+)/', $line, $m)) {
                $monkeyData['op'] = ['mul', (int) $m['n']];
                continue;
            }

            if (preg_match('/Test: divisible by (?<n>\d+)/', $line, $m)) {
                $monkeyData['divisibleBy'] = (int) $m['n'];
                continue;
            }

            if (preg_match('/If true: throw to monkey (?<m>\d+)/', $line, $m)) {
                $monkeyData['trueToMonkey'] = (int) $m['m'];
                continue;
            }

            if (preg_match('/If false: throw to monkey (?<m>\d+)/', $line, $m)) {
                $monkeyData['falseToMonkey'] = (int) $m['m'];
            }
        }

        foreach ($monkeys as $monkey) {
            ModuloNumber::addDivisor($monkey->divisibleBy);
        }

        foreach ($monkeys as $monkey) {
            foreach ($monkey->items as $item) {
                $item->updateReminders();
            }
        }

        return $monkeys;
    }
}
