<?php

declare(strict_types=1);

namespace AOC\Year2020\Day04;

use Generator;
use Safe\Exceptions\PcreException;

trait Shared
{
    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $validPassports = 0;
        $currentPassportParts = [];

        foreach ($input as $line) {
            if ($line !== '') {
                foreach (explode(' ', $line) as $field) {
                    $parts = explode(':', $field);
                    $currentPassportParts[$parts[0]] = $parts[1];
                }
            } else {
                $currentPassportParts['cid'] = 'asdf';
                ksort($currentPassportParts);
                if ($this->isValid($currentPassportParts)) {
                    ++$validPassports;
                }

                $currentPassportParts = [];
            }
        }

        return $validPassports;
    }
}
