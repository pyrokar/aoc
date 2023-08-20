<?php

declare(strict_types=1);

namespace AOC\Year2015\Day22;

class PartTwo
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

    protected function beforePlayerTurn(GameState $state): GameState
    {
        return new GameState(
            $state->bossHP,
            $state->playerHP - 1,
            $state->playerArmor,
            $state->playerMana,
            $state->playerManaSpend,
            $state->activeSpells,
        );
    }
}
