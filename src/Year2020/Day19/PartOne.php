<?php

declare(strict_types=1);

namespace AOC\Year2020\Day19;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    use Shared;

    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        [$rules, $messages] = $this->processInput($input);

        $regex = '/^' . $rules->get(0) . '$/';

        $matches = 0;

        foreach ($messages as $message) {
            if (preg_match($regex, $message)) {
                ++$matches;
            }
        }

        return $matches;
    }
}
