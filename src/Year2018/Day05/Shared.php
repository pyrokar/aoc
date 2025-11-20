<?php

declare(strict_types=1);

namespace AOC\Year2018\Day05;

trait Shared
{
    /**
     * @param string $input
     *
     * @return int
     */
    protected function react(string $input): int
    {
        $l = strlen($input) - 1;

        for ($i = 0; $i < $l; $i++) {
            $a = $input[$i];
            $b = $input[$i + 1];

            if (strcasecmp($a, $b)) {
                continue;
            }

            if ((ctype_lower($a) && ctype_lower($b)) | (ctype_upper($a) && ctype_upper($b))) {
                continue;
            }

            $input = substr($input, 0, $i) . substr($input, $i + 2);
            $l -= 2;

            if ($i === 0) {
                --$i;
            } else {
                $i -= 2;
            }
        }

        return strlen($input);
    }
}
