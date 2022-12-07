<?php declare(strict_types=1);

namespace AOC\Year2022\Day05;

use Generator;

use Safe\Exceptions\PcreException;
use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     * @param array<int, array<string>> $startingStacks
     * @return string
     * @throws PcreException
     */
    public function __invoke(Generator $input, array $startingStacks): string
    {
        $message = '';

        foreach ($input as $line) {
            if (!preg_match('/move (?<amount>\d+) from (?<from>\d+) to (?<to>\d+)/', $line, $m)) {
                continue;
            }

            $amount = (int) $m['amount'];
            $from = (int) $m['from'] - 1;
            $to = (int) $m['to'] - 1;

            for ($i = 0; $i < $amount; $i++) {
                $crate = array_pop($startingStacks[$from]);
                $startingStacks[$to][] = $crate;
            }
        }

        foreach ($startingStacks as &$stack) {
            $message .= $stack[array_key_last($stack)];
        }


        return $message;
    }
}
