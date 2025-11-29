<?php

declare(strict_types=1);

namespace AOC\Year2024\Day17;

use function array_map;
use function implode;

final class PartOne
{
    use Shared;

    /**
     * @param string $input
     * @param int $a
     *
     * @return string
     */
    public function __invoke(string $input, int $a = 0): string
    {
        $this->program = array_map(intval(...), explode(',', $input));

        $this->reset($a);

        $output = [];

        while (($out = $this->run()) !== -1) {
            $output[] = $out;
        }

        return implode(',', $output);
    }

}
