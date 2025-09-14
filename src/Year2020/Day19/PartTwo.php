<?php

declare(strict_types=1);

namespace AOC\Year2020\Day19;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
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

        $rules->set(8, fn(): string => '(' . $rules->get(42) . ')+');
        $rules->set(11, fn(): string => '(?<R>' . $rules->get(42) . $rules->get(31) . '|(' . $rules->get(42) . '(?&R)' . $rules->get(31) . '))');

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
