<?php

declare(strict_types=1);

namespace AOC\Year2022\Day13;

use Generator;

use function Safe\json_decode;
use function Safe\json_encode;

class PartTwo
{
    use Comparator;

    /**
     * @param Generator<string> $input
     *
     * @throws \JsonException
     *
     * @return int
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

            $packets[] = json_decode($line, true, 512, JSON_THROW_ON_ERROR);
        }

        usort($packets, [$this, 'compare']);

        $product = 1;

        foreach ($packets as $i => $p) {
            if (json_encode($p, JSON_THROW_ON_ERROR) === '[[2]]') {
                $product = $i + 1;
                continue;
            }

            if (json_encode($p, JSON_THROW_ON_ERROR) === '[[6]]') {
                $product *= $i + 1;
                break;
            }
        }

        return $product;
    }
}
