<?php

declare(strict_types=1);

namespace AOC\Year2015\Day22;

class PartOne
{
    use WizardGame;

    /**
     * @param int $bossHP
     * @param int $bossDamage
     * @param int $playerHP
     * @param int $playerMana
     *
     * @return int
     */
    public function __invoke(int $bossHP, int $bossDamage, int $playerHP, int $playerMana): int
    {
        $this->init($bossDamage);

        $this->playerTurn(new GameState($bossHP, $playerHP, 0, $playerMana, 0, []));

        return $this->minCost;
    }

}
