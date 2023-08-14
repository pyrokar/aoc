<?php

declare(strict_types=1);

namespace AOC\Year2015\Day21;

class PartOne
{
    use Shop;

    /**
     * @param int $bossHitpoints
     * @param int $bossDamage
     * @param int $bossArmor
     * @param int $playerHitpoints
     * @return int
     */
    public function __invoke(int $bossHitpoints, int $bossDamage, int $bossArmor, int $playerHitpoints): int
    {
        $minCost = PHP_INT_MAX;

        foreach ($this->getEquipments() as ['cost' => $cost, 'damage' => $playerDamage, 'armor' => $playerArmor]) {
            if ($cost >= $minCost) {
                continue;
            }

            $bossDec = max($playerDamage - $bossArmor, 1);
            $playerDec = max($bossDamage - $playerArmor, 1);

            if ($this->win($bossHitpoints, $bossDec, $playerHitpoints, $playerDec)) {
                $minCost = $cost;
            }
        }

        return $minCost;
    }

    private function win(int $bossHitpoints, int $bossDec, int $playerHitpoints, int $playerDec): bool
    {
        do {
            $bossHitpoints -= $bossDec;
            if ($bossHitpoints <= 0) {
                break;
            }
            $playerHitpoints -= $playerDec;
        } while (true);

        return $playerHitpoints > 0;
    }

}
