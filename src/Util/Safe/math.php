<?php

declare(strict_types=1);

namespace AOC\Util\Safe;

use Safe\Exceptions\ArrayException;

/**
 * @template T
 *
 * @param non-empty-list<T> $value
 *
 * @throws ArrayException
 *
 * @return T
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
 * @param non-empty-list<T> $value
 *
 * @throws ArrayException
 *
 * @return T
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
