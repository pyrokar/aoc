<?php

declare(strict_types=1);

namespace AOC\Year2018\Day13;

use function array_values;

final class PartTwo
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
        if (count($carts) === 1 && array_values($carts)[0] === $cart) {
            return array_values($carts)[0]->position->getKey(',');
        }

        $toUnset = [];

        foreach ($carts as $i => $otherCart) {
            if ($cart === $otherCart) {
                $toUnset[] = $i;
                continue;
            }

            if ($otherCart->position->getKey() === $cart->position->getKey()) {
                $toUnset[] = $i;
            }
        }

        if (count($toUnset) === 2) {
            unset($carts[$toUnset[0]], $carts[$toUnset[1]]);
        }

        return '';
    }
}
