<?php declare(strict_types=1);

namespace AOC\Year2022\Day03;

use Generator;

use function Safe\preg_match_all;

class PartTwo
{
    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $values = array_flip(array_merge(range('a', 'z'), range('A', 'Z')));

        $sum = 0;

        while ($input->valid()) {
            $first = $input->current();
            $input->next();
            $second = $input->current();
            $input->next();
            $third = $input->current();
            $input->next();

            foreach (str_split($third) as $char) {
                if (str_contains($first, $char) && str_contains($second, $char)) {
                    $sum += $values[$char] + 1;
                    continue 2;
                }
            }
        }

        return $sum;
    }
}
