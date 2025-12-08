<?php

declare(strict_types=1);

namespace AOC\Year2025\Day08;

use AOC\Util\Position3D;
use Generator;

trait Shared
{
    /** @var array<string, Position3D>  */
    protected array $boxes;

    /** @var array<string, float> */
    protected array $distances;

    /** @var array<string, string> */
    protected array $boxInCircuit;

    /** @var array<string, array<string, int>> */
    protected array $circuits;

    /**
     * @param string $circuitA
     * @param string $circuitB
     *
     * @return void
     */
    public function mergeCircuits(string $circuitA, string $circuitB): void
    {

        if ($this->boxInCircuit[$circuitA] !== $this->boxInCircuit[$circuitB]) {
            $oldKey = $this->boxInCircuit[$circuitB];
            foreach ($this->circuits[$oldKey] as $box => $v) {
                $this->circuits[$this->boxInCircuit[$circuitA]][$box] = 1;
                $this->boxInCircuit[$box] = $this->boxInCircuit[$circuitA];
            }

            unset($this->circuits[$oldKey]);
        }
    }

    protected static function getDistance(Position3D $a, Position3D $b): float
    {
        return sqrt(($a->x - $b->x) ** 2 + ($a->y - $b->y) ** 2 + ($a->z - $b->z) ** 2);
    }

    /**
     * @param Generator $input
     *
     * @return void
     */
    protected function init(Generator $input): void
    {
        $this->boxes = [];
        $this->distances = [];
        $this->circuits = [];
        $this->boxInCircuit = [];

        foreach ($input as $key) {
            $box = Position3D::fromKey($key, ',');

            $this->boxes[$key] = $box;

            $this->boxInCircuit[$key] = $key;
            $this->circuits[$key] = [$key => 1];

            foreach ($this->boxes as $otherKey => $otherBox) {
                if ($key === $otherKey) {
                    continue;
                }

                $this->distances[$key . '-' . $otherKey] = self::getDistance($box, $otherBox);
            }
        }

        asort($this->distances);
    }
}
