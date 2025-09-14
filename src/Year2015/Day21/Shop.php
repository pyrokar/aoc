<?php

declare(strict_types=1);

namespace AOC\Year2015\Day21;

use Generator;

trait Shop
{
    /**
     * @var array<array{cost: int, armor: int}>
     */
    protected array $armor = [
        ['cost' => 0, 'armor' => 0],
        ['cost' => 13, 'armor' => 1],
        ['cost' => 31, 'armor' => 2],
        ['cost' => 53, 'armor' => 3],
        ['cost' => 75, 'armor' => 4],
        ['cost' => 102, 'armor' => 5],
    ];

    /**
     * @var array<array{cost: int, damage: int, armor: int}>
     */
    protected array $rings = [
        ['cost' => 0, 'damage' => 0, 'armor' => 0],
        ['cost' => 25, 'damage' => 1, 'armor' => 0],
        ['cost' => 50, 'damage' => 2, 'armor' => 0],
        ['cost' => 100, 'damage' => 3, 'armor' => 0],
        ['cost' => 20, 'damage' => 0, 'armor' => 1],
        ['cost' => 40, 'damage' => 0, 'armor' => 2],
        ['cost' => 80, 'damage' => 0, 'armor' => 3],
    ];

    /**
     * @var array<array{cost: int, damage: int}>
     */
    protected array $weapons = [
        ['cost' => 8, 'damage' => 4],
        ['cost' => 10, 'damage' => 5],
        ['cost' => 25, 'damage' => 6],
        ['cost' => 40, 'damage' => 7],
        ['cost' => 74, 'damage' => 8],
    ];

    /**
     * @return Generator<int, array{cost: int, damage: int, armor: int}, void, void>
     */
    protected function getEquipments(): Generator
    {
        for ($weapon = 0; $weapon < 5; ++$weapon) {
            for ($armor = 0; $armor < 6; ++$armor) {
                for ($ring1 = 0; $ring1 < 7; ++$ring1) {
                    for ($ring2 = 0; $ring2 < 7; ++$ring2) {
                        if ($ring1 === $ring2 && $ring1 > 0) {
                            continue;
                        }

                        yield [
                            'cost' => $this->weapons[$weapon]['cost'] + $this->armor[$armor]['cost'] + $this->rings[$ring1]['cost'] + $this->rings[$ring2]['cost'],
                            'damage' => $this->weapons[$weapon]['damage'] + $this->rings[$ring1]['damage'] + $this->rings[$ring2]['damage'],
                            'armor' => $this->armor[$armor]['armor'] + $this->rings[$ring1]['armor'] + $this->rings[$ring2]['armor'],
                        ];
                    }
                }
            }
        }
    }
}
