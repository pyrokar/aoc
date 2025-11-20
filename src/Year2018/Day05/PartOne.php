<?php

declare(strict_types=1);

namespace AOC\Year2018\Day05;

final class PartOne
{
    use Shared;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        return $this->react($input);
    }

}
