<?php

declare(strict_types=1);

namespace AOC\Year2022\Day13;

use Generator;

use Safe\Exceptions\JsonException;

use function Safe\json_decode;

class PartOne
{
    use Comparator;

    /**
     * @param Generator<string> $input
     *
     * @throws JsonException
     * @throws \JsonException
     *
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

            /** @var array<mixed> $first */
            $first = json_decode($line, true, 512, JSON_THROW_ON_ERROR);
            $input->next();
            $line = $input->current();
            /** @var array<mixed> $second */
            $second = json_decode($line, true, 512, JSON_THROW_ON_ERROR);

            if ($this->compare($first, $second) === -1) {
                $sum += $pairIndex;
            }

        }

        return $sum;
    }
}
