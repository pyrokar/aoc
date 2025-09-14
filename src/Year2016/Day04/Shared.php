<?php

declare(strict_types=1);

namespace AOC\Year2016\Day04;

trait Shared
{
    protected function isRealRoom(string $encryptedName, string $checksum): bool
    {
        $chars = array_count_values(str_split($encryptedName));
        unset($chars['-']);

        uksort($chars, static function (string $k1, string $k2) use ($chars): int {
            if ($chars[$k1] === $chars[$k2]) {
                return strcmp($k1, $k2);
            }

            return $chars[$k2] <=> $chars[$k1];
        });

        return implode('', array_keys(array_splice($chars, 0, 5))) === $checksum;
    }
}
