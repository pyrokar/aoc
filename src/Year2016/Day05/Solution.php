<?php declare(strict_types=1);

namespace AOC\Year2016\Day05;

use AOC\Util\SolutionInterface;
use AOC\Util\SolutionUtil;
use Generator;

class Solution implements SolutionInterface
{
    use SolutionUtil;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @return string
     */
    public function solvePartOne(Generator $input): string
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

    /**
     * @param Generator<int, string, void, void> $input
     *
     * @return string
     */
    public function solvePartTwo(Generator $input): string
    {
        $passwordLength = 8;

        $doorID = $input->current();
        $password = [];
        $index = 0;

        for ($i = 0; $i < $passwordLength;) {
            while (strncasecmp(md5($doorID . $index), '00000', 5)) {
                ++$index;
            }

            $md5 = md5($doorID . $index);
            $pos = is_numeric($md5[5]) ? (int) $md5[5] : $passwordLength;

            if ($pos >= $passwordLength || isset($password[$pos])) {
                ++$index;
                continue;
            }

            $password[$pos] = $md5[6];
            ++$i;
            ++$index;
        }

        ksort($password);
        return implode('', $password);
    }
}
