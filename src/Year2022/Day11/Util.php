<?php

namespace AOC\Year2022\Day11;

use function Safe\preg_match;

trait Util
{
    /**
     * @param $input
     * @return array<Monkey>
     * @throws \Safe\Exceptions\JsonException
     * @throws \Safe\Exceptions\PcreException
     */
    private function inputToMonkeys($input): array
    {
        $monkeys = [];

        $monkeyData = [];

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
                $monkeyData = [];
                continue;
            }

            if (preg_match('/Starting items: (?<items>.*)/', $line, $m)) {
                $items = \Safe\json_decode('[' . $m['items'] . ']');
                $monkeyData['items'] = array_map(fn ($i) => new ModuloNumber($i), $items);

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
