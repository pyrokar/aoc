<?php

declare(strict_types=1);

namespace AOC\Year2018\Day13;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Generator;
use UnexpectedValueException;

trait Shared
{
    /**
     * @param Generator<int, string> $input
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        Position2D::invertY();

        $tracks = [];
        /** @var non-empty-list<Cart> $carts */
        $carts = [];

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === ' ' || $char === "\n") {
                    continue;
                }

                $key = Position2D::key($x, $y);

                if (in_array($char, ['-', '|', '/', '\\', '+'], true)) {
                    $tracks[$key] = $char;
                    continue;
                }

                $tracks[$key] = match ($char) {
                    '^', 'v' => '|',
                    '<', '>' => '-',
                    default => throw new UnexpectedValueException($char),
                };

                $position = new Position2D($x, $y);
                $direction = match ($char) {
                    '^' => CompassDirection::North,
                    '>' => CompassDirection::East,
                    'v' => CompassDirection::South,
                    '<' => CompassDirection::West,
                    default => throw new UnexpectedValueException($char),
                };

                $carts[] = new Cart($position, $direction);
            }
        }

        while (true) {
            usort($carts, static function (Cart $cartA, Cart $cartB): int {
                if ($cartA->position->y === $cartB->position->y) {
                    return $cartA->position->x - $cartB->position->x;
                }

                return $cartA->position->y - $cartB->position->y;
            });

            foreach ($carts as $cart) {
                $cart->move($tracks);

                if (($result = $this->afterMove($cart, $carts)) !== '') {
                    return $result;
                }
            }
        }
    }

    abstract protected function afterMove(Cart $cart, array &$carts): string;

}
