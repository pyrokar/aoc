<?php declare(strict_types=1);

namespace AOC\Year2016\Day12;

use Generator;

class PartTwo
{
    use Machine;

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return $this->runMaschine($input, ['c' => 1])->readRegister('a');
    }
}
