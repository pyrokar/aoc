<?php

declare(strict_types=1);

namespace AOC\Year2015\Day21;

class PartTwo
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
        $maxCost = 0;

        foreach ($this->getEquipments() as ['cost' => $cost, 'damage' => $playerDamage, 'armor' => $playerArmor]) {
            if ($cost <= $maxCost) {
                continue;
            }

            $bossDec = max($playerDamage - $bossArmor, 1);
            $playerDec = max($bossDamage - $playerArmor, 1);

            if ($this->lose($bossHitpoints, $bossDec, $playerHitpoints, $playerDec)) {
                $maxCost = $cost;
            }
        }

        return $maxCost;
    }

    private function lose(int $bossHitpoints, int $bossDec, int $playerHitpoints, int $playerDec): bool
    {
        do {
            $bossHitpoints -= $bossDec;
            if ($bossHitpoints <= 0) {
                break;
            }
            $playerHitpoints -= $playerDec;
        } while (true);

        return $playerHitpoints <= 0;
    }
}
