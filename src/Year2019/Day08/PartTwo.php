<?php

declare(strict_types=1);

namespace AOC\Year2019\Day08;

use function str_split;

final class PartTwo
{
    /**
     * @param string $input
     * @param positive-int $width
     * @param positive-int $height
     *
     * @return string
     */
    public function __invoke(string $input, int $width, int $height): string
    {
        $layers = str_split($input, $width * $height);
        $result = '';

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $pos = $width * $y + $x;

                $pixel = '2';

                foreach ($layers as $layer) {
                    if ($layer[$pos] !== '2') {
                        $pixel = $layer[$pos];
                        break;
                    }
                }

                $result .= $pixel;
                echo $pixel === '1' ? '#' : ' ';
            }
            echo PHP_EOL;
        }

        return $result;
    }
}
