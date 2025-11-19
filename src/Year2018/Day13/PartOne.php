<?php

declare(strict_types=1);

namespace AOC\Year2018\Day13;

final class PartOne
{
    use Shared;

    /**
     * @param Cart $cart
     * @param array<Cart> $carts
     *
     * @return string
     */
    protected function afterMove(Cart $cart, array &$carts): string
    {
        foreach ($carts as $otherCart) {
            if ($cart === $otherCart) {
                continue;
            }

            if ($otherCart->position->getKey() === $cart->position->getKey()) {
                return $cart->position->getKey(',');
            }
        }

        return '';
    }
}
