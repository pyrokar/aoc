<?php

declare(strict_types=1);

namespace AOC\Year2023\Day19;

use Generator;

use Safe\Exceptions\PcreException;

use function array_map;
use function array_product;
use function array_sum;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->workflows = [];
        $this->acceptedRanges = [];

        foreach ($input as $line) {
            $this->extractWorkflow($line);
        }

        $this->findAcceptedRanges();

        return (int) array_sum(array_map(static fn(array $ranges) => array_product(array_map(fn(array $range) => $range[1] - $range[0], $ranges)), $this->acceptedRanges));
    }

}
