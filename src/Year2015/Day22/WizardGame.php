<?php

declare(strict_types=1);

namespace AOC\Year2015\Day22;

trait WizardGame
{
    /** @var array<string, array{cost: int, damage?: int, heal?: int, turns: int}>  */
    protected array $spellsStats = [
        'magicMissile' => ['cost' => 53, 'damage' => 4, 'turns' => 0],
        'drain' => ['cost' => 73, 'damage' => 2, 'heal' => 2, 'turns' => 0],
        'shield' => ['cost' => 113, 'armor' => 7, 'turns' => 6],
        'poison' => ['cost' => 173, 'damage' => 3, 'turns' => 6],
        'recharge' => ['cost' => 229, 'mana' => 101, 'turns' => 5],
    ];

    /** @var list<string>  */
    protected array $spells = ['magicMissile', 'drain', 'shield', 'poison', 'recharge'];
    protected int $bossDamage;
    protected int $minCost;

    protected function init(int $bossDamage): void
    {
        $this->bossDamage = $bossDamage;
        $this->minCost = PHP_INT_MAX;
    }

    protected function beforePlayerTurn(GameState $state): GameState
    {
        return $state;
    }

    /**
     * @param GameState $state
     *
     * @return GameState
     */
    public function applySpells(GameState $state): GameState
    {
        $bossHP = $state->bossHP;
        $playerArmor = 0;
        $playerMana = $state->playerMana;
        $activeSpells = [];
        foreach ($state->activeSpells as $activeSpell => $lasts) {
            switch ($activeSpell) {
                case 'shield':
                    $playerArmor = 7;
                    break;
                case 'poison':
                    $bossHP -= 3;
                    break;
                case 'recharge':
                    $playerMana += 101;
                    break;
            }
            if ($lasts > 1) {
                $activeSpells[$activeSpell] = --$lasts;
            }
        }
        return new GameState($bossHP, $state->playerHP, $playerArmor, $playerMana, $state->playerManaSpend, $activeSpells);
    }

    protected function playerTurn(GameState $state): void
    {
        $state = $this->beforePlayerTurn($state);
        if ($state->bossWins()) {
            return;
        }

        // apply spells
        $state = $this->applySpells($state);

        if ($state->playerWins()) {
            $this->minCost = min($this->minCost, $state->playerManaSpend);

            return;
        }

        // cast spell
        foreach ($this->spells as $spell) {
            if (isset($state->activeSpells[$spell])) {
                continue;
            }

            $spellCost = $this->spellsStats[$spell]['cost'];

            if ($state->playerMana <= $spellCost) {
                continue;
            }

            if ($this->minCost < $state->playerManaSpend + $spellCost) {
                continue;
            }

            $bossHPDec = 0;
            $playerHPInc = 0;
            $newEffects = [];

            switch ($spell) {
                case 'magicMissile':
                    $bossHPDec = 4;
                    break;
                case 'drain':
                    $bossHPDec = 2;
                    $playerHPInc = 2;
                    break;
                default:
                    $newEffects[$spell] = $this->spellsStats[$spell]['turns'];
            }

            if ($state->bossHP - $bossHPDec <= 0) {
                // player wins
                $this->minCost = min($this->minCost, $state->playerManaSpend + $spellCost);

                return;
            }

            $this->bossTurn(new GameState($state->bossHP - $bossHPDec, $state->playerHP + $playerHPInc, $state->playerArmor, $state->playerMana - $spellCost, $state->playerManaSpend + $spellCost, array_merge($state->activeSpells, $newEffects)));
        }
    }

    protected function bossTurn(GameState $state): void
    {
        // apply spells
        $state = $this->applySpells($state);

        if ($state->playerWins()) {
            // player wins
            $this->minCost = min($this->minCost, $state->playerManaSpend);

            return;
        }

        // boss attack
        $playerHP = $state->playerHP - $this->bossDamage + $state->playerArmor;

        if ($playerHP <= 0) {
            // boss wins;
            return;
        }

        $this->playerTurn(new GameState($state->bossHP, $playerHP, $state->playerArmor, $state->playerMana, $state->playerManaSpend, $state->activeSpells));
    }
}
