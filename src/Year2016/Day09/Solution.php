<?php

declare(strict_types=1);

namespace AOC\Year2016\Day09;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

trait Solution
{
    /**
     * @throws PcreException
     */
    private function decompress(string $input, bool $recursive): int
    {
        $length = 0;

        $inMarker = false;
        $marker = '';

        for ($i = 0, $l = strlen($input); $i < $l; ++$i) {
            $char = $input[$i];
            if ($char !== '(' && !$inMarker) {
                ++$length;
            } elseif ($char === '(' && !$inMarker) {
                $inMarker = true;
            } elseif ($char === ')' && $inMarker) {
                preg_match('/(\d+)x(\d+)/', $marker, $m);

                if ($recursive) {
                    $length +=  (int) $m[2] * $this->decompress(substr($input, $i + 1, (int) $m[1]), true);
                } else {
                    $length += (int) $m[1] * (int) $m[2];
                }

                $i += (int) $m[1];

                $marker = '';
                $inMarker = false;
            } elseif ($inMarker) {
                $marker .= $char;
            }
        }

        return $length;
    }
}
