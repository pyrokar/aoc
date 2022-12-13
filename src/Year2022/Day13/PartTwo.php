<?php declare(strict_types=1);

namespace AOC\Year2022\Day13;

use Generator;
use Safe\Exceptions\ArrayException;

class PartTwo
{
    use Comparator;
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     * @throws ArrayException
     */
    public function __invoke(Generator $input): int
    {
        $packets = [
            [[2]],
            [[6]],
        ];

        foreach ($input as $line) {

            if ($line === '') {
                continue;
            }

            $packets[] = json_decode($line);
        }

        usort($packets, [$this, 'compare']);

        $product = 1;

        foreach ($packets as $i => $p) {
            if (json_encode($p) === '[[2]]') {
                $product = $i + 1;
                continue;
            }

            if (json_encode($p) === '[[6]]') {
                $product *= $i + 1;
                break;
            }
        }

        return $product;
    }
}
