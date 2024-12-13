<?php

declare(strict_types=1);

namespace AOC\Year2024\Day12;

use AOC\Util\Position2D;
use Generator;

trait Shared
{
    /**
     * @param Generator $input
     *
     * @return array{array<string, string>, array<string, array<string, string>>}
     */
    protected function init(Generator $input): array
    {
        $map = [];
        /** @var array<string, array<string, string>> $regions */
        $regions = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                $key = Position2D::key($x, $y);
                $regions[$char][$key] = $key;
                $map[$key] = $char;
            }
        }

        $newRegions = [];

        foreach ($regions as $char => $keys) {

            $i = 0;

            while (count($keys) > 0) {
                $newRegion = $char . '-' . $i;
                $key = array_shift($keys);

                $newRegions[$newRegion] = $this->getRegion($key, $keys);

                $i++;
            }
        }
        return [$map, $newRegions];
    }

    /**
     * @param string $startKey
     * @param array<string, string> $keys
     *
     * @return array<string, string>
     */
    protected function getRegion(string $startKey, array &$keys): array
    {
        $region = [$startKey => $startKey];
        $stack = [$startKey];

        while (!empty($stack)) {
            $key = array_shift($stack);

            foreach (Position2D::fromKey($key)->getOrthogonalNeighborKeys() as $neighborKey) {
                if (isset($keys[$neighborKey])) {
                    $region[$neighborKey] = $neighborKey;
                    unset($keys[$neighborKey]);
                    $stack[] = $neighborKey;
                }
            }
        }

        return $region;
    }
}
