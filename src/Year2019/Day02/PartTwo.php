<?php

declare(strict_types=1);

namespace AOC\Year2019\Day02;

use AOC\Year2019\IntCodeComputer;
use Generator;
use Safe\Exceptions\ArrayException;

use function array_map;
use function explode;
use function Safe\array_replace;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @throws ArrayException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $memory = array_map(intval(...), explode(',', $input->current()));
        $targetOutput = 19690720;

        $icc = new IntCodeComputer();

        for ($noun = 0; $noun < 100; $noun++) {
            for ($verb = 0; $verb < 100; $verb++) {

                $icc->setMemory(array_replace($memory, [1 => $noun, 2 => $verb]));
                $icc->execute();

                if ($icc->getMemory()[0] === $targetOutput) {
                    return 100 * $noun + $verb;
                }
            }
        }

        return -1;
    }
}
