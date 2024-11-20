<?php

declare(strict_types=1);

namespace AOC\Year2019\Day13;

use AOC\Year2019\IntCodeComputer;

final class PartOne
{
    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $arcadeCabinet = IntCodeComputer::fromString($input);

        $arcadeCabinet->execute();

        $output = $arcadeCabinet->getOutput();

        $blockTiles = 0;

        for ($i = 2, $l = count($output); $i < $l; $i += 3) {
            if ($output[$i] === 2) {
                $blockTiles++;
            }
        }

        return $blockTiles;
    }
}
