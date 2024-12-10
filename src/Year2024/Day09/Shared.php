<?php

declare(strict_types=1);

namespace AOC\Year2024\Day09;

trait Shared
{
    protected function calcBlockChecksum(int $blockId, int $blockLength, int $position): int
    {
        return (int) ($blockId * $blockLength * ($position + ($blockLength - 1) / 2));
    }
}
