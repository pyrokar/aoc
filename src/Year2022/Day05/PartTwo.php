<?php declare(strict_types=1);

namespace AOC\Year2022\Day05;

use Generator;

use function Safe\preg_match_all;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
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

            $crates = [];
            for ($i = 0; $i < $amount; $i++) {
                $crates[] = array_pop($startingStacks[$from]);
            }

            for ($i = $amount - 1; $i >= 0; $i--) {
                $startingStacks[$to][] = $crates[$i];
            }
        }

        foreach ($startingStacks as &$stack) {
            $message .= $stack[array_key_last($stack)];
        }


        return $message;
    }
}
