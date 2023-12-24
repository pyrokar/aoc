<?php

declare(strict_types=1);

namespace AOC\Year2023\Day22;

use Generator;

/**
 * @phpstan-import-type BrickId from Shared
 * @phpstan-import-type ListOfBrickIds from Shared
 */
class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->letThemFall($input);

        $disintegratedBricks = $this->getDisintegratedBricks();

        $sum = 0;

        foreach ($this->bricks as $brickId => $_) {
            if (isset($disintegratedBricks[$brickId])) {
                continue;
            }

            $sum += count($this->disintegrateBrickAndGetFallingBricks($brickId, $disintegratedBricks)) - 1;
        }

        return $sum;
    }

    /**
     * @param BrickId $brickId
     * @param ListOfBrickIds $disintegratedBricks
     * @param ListOfBrickIds $fallingBricks
     *
     * @return ListOfBrickIds
     */
    private function disintegrateBrickAndGetFallingBricks(string $brickId, array $disintegratedBricks, array &$fallingBricks = []): array
    {
        if (isset($fallingBricks[$brickId])) {
            return $fallingBricks;
        }

        $fallingBricks[$brickId] = 1;

        if (!isset($this->brickSupports[$brickId])) {
            return $fallingBricks;
        }

        $supportedBricks = $this->brickSupports[$brickId];

        foreach ($supportedBricks as $supportedBrickId => $_) {
            $supportedBrickCanFall = true;

            foreach ($this->brickIsSupportedBy[$supportedBrickId] as $otherSupportingBrickIds => $__) {
                if (!isset($fallingBricks[$otherSupportingBrickIds])) {
                    $supportedBrickCanFall = false;
                    break;
                }
            }

            if ($supportedBrickCanFall) {
                $this->disintegrateBrickAndGetFallingBricks($supportedBrickId, $disintegratedBricks, $fallingBricks);
            }
        }

        return $fallingBricks;
    }
}
