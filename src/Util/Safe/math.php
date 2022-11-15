<?php

namespace AOC\Util\Safe;

use Safe\Exceptions\ArrayException;

/**
 * @template T
 *
 * @param T[] $value
 * @return T
 * @throws ArrayException
 */
function max(array $value): mixed
{
    error_clear_last();
    $result = \max($value);
    if ($result === false) {
        throw ArrayException::createFromPhpError();
    }
    return $result;
}

/**
 * @template T
 *
 * @param T[] $value
 * @return T
 * @throws ArrayException
 */
function min(array $value): mixed
{
    error_clear_last();
    $result = \min($value);
    if ($result === false) {
        throw ArrayException::createFromPhpError();
    }
    return $result;
}
