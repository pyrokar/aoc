<?php

declare(strict_types=1);

namespace AOC\Year2020\Day05;

trait Shared
{
    /**
     * @param string $line
     *
     * @return int
     */
    protected function getSeatID(string $line): int
    {
        $row = bindec(str_replace(['F', 'B'], ['0', '1'], substr($line, 0, 7)));
        $column = bindec(str_replace(['L', 'R'], ['0', '1'], substr($line, 7)));

        return (int) (8 * $row + $column);
    }
}
