<?php declare(strict_types=1);

/**
 * @template T
 *
 * @param array<T> $array
 * @param int $flags
 *
 * @return array<T>
 *
 * @see sort
 */
function array_sort(array $array, int $flags = SORT_REGULAR): array
{
    sort($array, $flags);
    return $array;
}

/**
 * @param callable(int, mixed, mixed...): void | null $callback
 * @param array $array
 * @param array ...$arrays
 *
 * @return array
 */
function array_map_key(?callable $callback, array $array, array ...$arrays): array
{
    return array_map($callback, array_keys($array), $array, ...$arrays);
}

/**
 * Returns all keys with the maximum value
 *
 * @param array<string, mixed> $array
 * @return array<string>
 */
function max_value_keys(array $array): array
{
    $maxValue = max($array);
    return array_keys(array_filter($array, static fn ($el) => $el === $maxValue));
}

/**
 * @link https://www.php.net/manual/de/function.str-rot13.php#107475
 *
 * @param string $s
 * @param int $n
 *
 * @return string
 */
function str_rot(string $s, int $n = 13): string
{
    static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
    $n %= 26;
    if (!$n) {
        return $s;
    }
    if ($n < 0) {
        $n += 26;
    }
    if ($n === 13) {
        return str_rot13($s);
    }
    $rep = substr($letters, $n * 2) . substr($letters, 0, $n * 2);
    return strtr($s, $letters, $rep);
}
