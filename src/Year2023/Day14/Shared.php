<?php

declare(strict_types=1);

namespace AOC\Year2023\Day14;

trait Shared
{
    /**
     * @param array<array<string>> $platform
     *
     * @return array<array<string>>
     */
    protected function rollRocks(array $platform): array
    {
        for ($y = 1, $h = count($platform); $y < $h; ++$y) {
            foreach ($platform[$y] as $x => $char) {
                if ($char === '.' || $char === '#') {
                    continue;
                }

                for ($dy = $y; $dy > 0; --$dy) {
                    $prevRow = $platform[$dy - 1];
                    if ($prevRow[$x] === '.') {
                        // rock rolls up
                        $platform[$dy][$x] = '.';
                        $platform[$dy - 1][$x] = 'O';
                    } else {
                        break;
                    }
                }
            }
        }

        return $platform;
    }
}
