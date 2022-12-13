<?php declare(strict_types=1);

namespace AOC\Year2022\Day13;

use Generator;

class PartOne
{
    use Comparator;

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $sum = 0;

        $pairIndex = 0;

        foreach ($input as $line) {

            if ($line === '') {
                continue;
            }

            $pairIndex++;

            $first = json_decode($line);
            $input->next();
            $line = $input->current();
            $second = json_decode($line);

            if ($this->compare($first, $second) === -1) {
                $sum += $pairIndex;
            }

        }

        return $sum;
    }
}
