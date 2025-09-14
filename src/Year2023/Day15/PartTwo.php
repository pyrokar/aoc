<?php

declare(strict_types=1);

namespace AOC\Year2023\Day15;

use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        /** @var list<list<array{string, int}>> $boxes */
        $boxes = array_fill(0, 256, []);

        foreach ($input as $line) {
            [$hash, $label, $operator, $focalLength] = $this->parseStep($line);

            if ($operator === '-') {
                foreach ($boxes[$hash] as $i => $lens) {
                    if ($lens[0] === $label) {
                        unset($boxes[$hash][$i]);
                        $boxes[$hash] = array_values($boxes[$hash]);
                        break;
                    }
                }
            } else {
                $found = false;
                foreach ($boxes[$hash] as &$lens) {
                    if ($lens[0] === $label) {
                        $lens[1] = $focalLength;
                        $found = true;
                        break;
                    }
                }

                unset($lens);

                if (!$found) {
                    $boxes[$hash][] = [$label, $focalLength];
                }
            }
        }

        $focusingPower = 0;

        foreach ($boxes as $i => $box) {
            $boxNumber = $i + 1;
            foreach ($box as $slot => $lens) {
                $focusingPower += $boxNumber * ($slot + 1) * $lens[1];
            }
        }

        return $focusingPower;
    }

    /**
     * @param string $step
     *
     * @return array{int, string, string, int}
     */
    private function parseStep(string $step): array
    {
        $hash = 0;

        $label = '';
        $operator = '';
        $focalLength = '0';

        foreach (str_split($step) as $char) {
            $ord = ord($char);

            if ($ord >= 97 && $ord <= 122) {
                $label .= $char;
                $hash = (($hash + $ord) * 17) % 256;
            } elseif ($char === '=') {
                $operator = '=';
            } elseif ($char === '-') {
                $operator = '-';
            } else {
                $focalLength = $char;
            }
        }

        return [$hash, $label, $operator, (int) $focalLength];
    }
}
