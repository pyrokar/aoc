<?php declare(strict_types=1);

namespace AOC\Year2022\Day07;

use Generator;

use Safe\Exceptions\PcreException;

class PartTwo
{
    use CalculateDirSize;

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        $dirSizes = $this->calculateDirSize($input);

        $target = $dirSizes['/'] - 40000000;

        return min(array_filter($dirSizes, static function ($dirSize) use ($target) {
            return $dirSize > $target;
        }));
    }
}
