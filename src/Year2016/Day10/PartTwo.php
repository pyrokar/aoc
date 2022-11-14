<?php declare(strict_types=1);

namespace AOC\Year2016\Day10;

use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init();

        $this->processInput($input);

        $this->executeInstructions();

        return $this->outputs[0] * $this->outputs[1] * $this->outputs[2];
    }
}
