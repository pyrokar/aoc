<?php

declare(strict_types=1);

namespace AOC\Year2019\Day02;

use Generator;

use function array_map;
use function explode;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $memory = array_map('intval', explode(',', $input->current()));

        $targetOutput = 19690720;

        for ($noun = 0; $noun < 100; $noun++) {
            for ($verb = 0; $verb < 100; $verb++) {

                $m = $this->run($memory, [1 => $noun, 2 => $verb]);

                if ($m[0] === $targetOutput) {
                    return 100 * $noun + $verb;
                }
            }
        }

        return -1;
    }
}
