<?php

declare(strict_types=1);

namespace AOC\Year2018\Day02;

use Generator;

use function implode;
use function levenshtein;
use function str_split;

final class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        $ids = [];

        foreach ($input as $newId) {

            foreach ($ids as $id) {
                if (levenshtein($id, $newId) === 1) {
                    return implode('', array_intersect_assoc(str_split($id), str_split($newId)));
                }

            }

            $ids[] = $newId;
        }

        return '';
    }
}
