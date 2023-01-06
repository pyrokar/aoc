<?php
declare(strict_types=1);

namespace AOC\Year2015\Day05;

use Generator;
use function AOC\Util\reduceInputByLine;
use function AOC\Util\reduceLineByChar;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        return reduceInputByLine($input, static function ($niceStrings, $line) {

            $countVowels = 0;
            $lastChar = '';
            $containsDoubleLetter = false;
            $containsNotNaughty = true;

            reduceLineByChar($line, function ($nice, $char) use (&$countVowels, &$lastChar, &$containsDoubleLetter, &$containsNotNaughty) {

                if (str_contains('aeiou', $char)) {
                    $countVowels++;
                }

                if ($lastChar === $char) {
                    $containsDoubleLetter = true;
                }

                if (in_array($lastChar . $char, ['ab', 'cd', 'pq', 'xy'])) {
                    $containsNotNaughty = false;
                }

                $lastChar = $char;

                return 0;
            });

            return $niceStrings + (int)($countVowels >= 3 && $containsDoubleLetter && $containsNotNaughty);
        }, 0);
    }
}
