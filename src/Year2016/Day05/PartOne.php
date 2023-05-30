<?php

declare(strict_types=1);

namespace AOC\Year2016\Day05;

use Generator;

class PartOne
{
    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return string
     */
    public function __invoke(Generator $input): string
    {
        $passwordLength = 8;

        $doorID = $input->current();
        $password = '';
        $index = 0;

        for ($i = 0; $i < $passwordLength; ++$i) {
            while (strncasecmp(md5($doorID . $index), '00000', 5)) {
                ++$index;
            }

            $md5 = md5($doorID . $index);

            $password .= $md5[5];
            ++$index;
        }

        return $password;
    }
}
