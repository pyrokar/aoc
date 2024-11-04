<?php

declare(strict_types=1);

namespace AOC\Year2019\Day05;

use function str_pad;
use function str_split;

use const STR_PAD_LEFT;

trait Shared
{
    /**
     * @param array<int, int> $memory
     * @param int $input
     *
     * @return int
     */
    protected function run(array $memory, int $input): int
    {
        $output = 0;
        $i = 0;

        while (true) {
            $instruction = str_split(str_pad((string) $memory[$i], 5, '0', STR_PAD_LEFT));

            $opcode = (int) ($instruction[3] . $instruction[4]);

            if ($opcode === 99) {
                break;
            }

            $value1 = $instruction[2] === '0' ? $memory[$memory[$i + 1]] : $memory[$i + 1];
            $value2 = $instruction[1] === '0' && isset($memory[$memory[$i + 2]]) ? $memory[$memory[$i + 2]] : $memory[$i + 2];

            switch ($opcode) {
                case 1:
                    $memory[$memory[$i + 3]] = $value1 + $value2;
                    $i += 4;
                    break;
                case 2:
                    $memory[$memory[$i + 3]] = $value1 * $value2;
                    $i += 4;
                    break;
                case 3:
                    $memory[$memory[$i + 1]] = $input;
                    $i += 2;
                    break;
                case 4:
                    $output = $value1;
                    $i += 2;
                    break;
                case 5:
                    if ($value1 !== 0) {
                        $i = $value2;
                    } else {
                        $i += 3;
                    }
                    break;
                case 6:
                    if ($value1 === 0) {
                        $i = $value2;
                    } else {
                        $i += 3;
                    }
                    break;
                case 7:
                    if ($value1 < $value2) {
                        $memory[$memory[$i + 3]] = 1;
                    } else {
                        $memory[$memory[$i + 3]] = 0;
                    }
                    $i += 4;
                    break;
                case 8:
                    if ($value1 === $value2) {
                        $memory[$memory[$i + 3]] = 1;
                    } else {
                        $memory[$memory[$i + 3]] = 0;
                    }
                    $i += 4;
                    break;
                default:
                    break 2;
            }
        }

        return $output;
    }
}
