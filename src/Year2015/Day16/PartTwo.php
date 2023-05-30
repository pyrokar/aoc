<?php

declare(strict_types=1);

namespace AOC\Year2015\Day16;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $myList = [
            'children' => 3,
            'cats' => 7,
            'samoyeds' => 2,
            'pomeranians' => 3,
            'akitas' => 0,
            'vizslas' => 0,
            'goldfish' => 5,
            'trees' => 3,
            'cars' => 2,
            'perfumes' => 1,
        ];

        foreach ($input as $line) {
            if (!preg_match('#Sue (?P<number>\d+): (?P<t0>\w+): (?P<a0>\d+), (?P<t1>\w+): (?P<a1>\d+), (?P<t2>\w+): (?P<a2>\d+)#', $line, $m)) {
                continue;
            }

            for ($i = 0; $i < 3; $i++) {
                $thing = $m['t' . $i];
                $amount = (int) $m['a' . $i];

                switch ($thing) {
                    case 'cats':
                    case 'trees':
                        if ($amount <= $myList[$thing]) {
                            continue 3;
                        }
                        break;
                    case 'pomeranians':
                    case 'goldfish':
                        if ($amount >= $myList[$thing]) {
                            continue 3;
                        }
                        break;
                    default:
                        if ($amount !== $myList[$thing]) {
                            continue 3;
                        }
                }
            }

            return (int) $m['number'];
        }

        return -1;
    }
}
