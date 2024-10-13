<?php

declare(strict_types=1);

namespace AOC\Year2019\Day02;

trait Shared
{
    /**
     * @param array<int, int> $memory
     * @param array<int, int> $overrideMem
     * @return array<int, int>
     */
    protected function run(array $memory, array $overrideMem = []): array
    {
        $memory = array_replace($memory, $overrideMem);

        $i = 0;
        $opcode = $memory[$i];

        while ($opcode !== 99) {
            if ($opcode === 1) {
                $memory[$memory[$i + 3]] = $memory[$memory[$i + 1]] + $memory[$memory[$i + 2]];

                $i += 4;
            } elseif ($opcode === 2) {
                $memory[$memory[$i + 3]] = $memory[$memory[$i + 1]] * $memory[$memory[$i + 2]];

                $i += 4;
            }

            $opcode = $memory[$i];
        }

        return $memory;
    }
}
