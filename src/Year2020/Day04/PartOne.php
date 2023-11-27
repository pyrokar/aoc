<?php

declare(strict_types=1);

namespace AOC\Year2020\Day04;

class PartOne
{
    use Shared;

    /**
     * @param array<string, string> $passport
     *
     * @return bool
     */
    protected function isValid(array $passport): bool
    {
        $count = count($passport);
        return $count === 8 || ($count === 7 && !isset($passport['cid']));
    }
}
