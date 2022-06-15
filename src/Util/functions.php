<?php declare(strict_types=1);

/**
 * @template T
 *
 * @param array<T> $array
 * @param int $flags
 *
 * @return array<T>
 *
 * @see \sort()
 */
function array_sort(array $array, int $flags = SORT_REGULAR): array
{
    sort($array, $flags);
    return $array;
}
