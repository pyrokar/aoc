<?php

declare(strict_types=1);

namespace AOC\Year2015\Day22;

class GameState
{
    /**
     * @param int $bossHP
     * @param int $playerHP
     * @param int $playerArmor
     * @param int $playerMana
     * @param int $playerManaSpend
     * @param array<string, int> $activeSpells
     */
    public function __construct(
        public readonly int $bossHP,
        public readonly int $playerHP,
        public readonly int $playerArmor,
        public readonly int $playerMana,
        public readonly int $playerManaSpend,
        public readonly array $activeSpells,
    ) {}

    public function bossWins(): bool
    {
        return $this->playerHP <= 0;
    }

    public function playerWins(): bool
    {
        return $this->bossHP <= 0;
    }
}
