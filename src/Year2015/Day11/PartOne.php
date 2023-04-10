<?php
declare(strict_types=1);

namespace AOC\Year2015\Day11;

use Generator;
use Safe\Exceptions\PcreException;
use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return string
     * @throws PcreException
     */
    public function __invoke(Generator $input): string
    {
        $password = $input->current();
        $password = $this->incPassword($password);

        while (!$this->isValid($password)) {
            $password = $this->incPassword($password);
        }

        return $password;
    }

    /**
     * @throws PcreException
     */
    private function isValid(string $password): bool
    {
        if (preg_match('/[ilo]/', $password)) {
            return false;
        }

        if (!preg_match('/(\w)\1.*([^\1])\2/', $password)) {
            return false;
        }

        $secondLastOrd = -1;
        $lastOrd = -1;
        $increasingStraightFound = false;

        foreach (str_split($password) as $char) {
            $ord = ord($char);
            if ($secondLastOrd + 1 === $lastOrd && $lastOrd + 1 === $ord) {
                $increasingStraightFound = true;
            }

            if ($lastOrd + 1 === $ord) {
                $secondLastOrd = $lastOrd;
            } else {
                $secondLastOrd = -1;
            }
            $lastOrd = $ord;

        }

        return $increasingStraightFound;
    }

    private function incPassword(string $password): string
    {
        $a = str_split($password);
        $l = strlen($password);
        $wrap = true;

        $result = '';

        for ($i = $l - 1; $i >= 0; $i--) {
            $o = ord($a[$i]) - 97;
            $inc = 0;

            if ($wrap) {
                $wrap = false;
                $inc = 1;
                if ($o === 25) {
                    $wrap = true;
                    $inc -= 26;
                }
            }

            $result .= chr($o + 97 + $inc);
        }

        return strrev($result);
    }
}
