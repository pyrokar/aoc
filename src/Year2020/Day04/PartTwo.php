<?php

declare(strict_types=1);

namespace AOC\Year2020\Day04;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    use Shared;

    /**
     * @param array<string, string> $passport
     *
     * @throws PcreException
     *
     * @return bool
     */
    protected function isValid(array $passport): bool
    {
        if (count($passport) !== 8) {
            return false;
        }

        if (!preg_match('/^\d{4}$/', $passport['byr']) || $passport['byr'] < 1920 || $passport['byr'] > 2002) {
            return false;
        }

        if (!preg_match('/^\d{4}$/', $passport['iyr']) || $passport['iyr'] < 2010 || $passport['iyr'] > 2020) {
            return false;
        }

        if (!preg_match('/^\d{4}$/', $passport['eyr']) || $passport['eyr'] < 2020 || $passport['eyr'] > 2030) {
            return false;
        }

        if (!preg_match('/^(?<number>\d+)(?<unit>cm|in)$/', $passport['hgt'], $m)) {
            return false;
        }

        if ($m['unit'] === 'cm') {
            if ($m['number'] < 150 || $m['number'] > 193) {
                return false;
            }
        } elseif ($m['number'] < 59 || $m['number'] > 76) {
            return false;
        }

        if (!preg_match('/^#[a-f0-9]{6}$/', $passport['hcl'])) {
            return false;
        }

        if (!in_array($passport['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true)) {
            return false;
        }

        if (!preg_match('/^\d{9}$/', $passport['pid'])) {
            return false;
        }

        return true;
    }
}
