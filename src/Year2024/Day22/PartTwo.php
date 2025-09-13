<?php

declare(strict_types=1);

namespace AOC\Year2024\Day22;

use Generator;

use LogicException;

use function AOC\Util\Safe\array_shift;
use function array_slice;
use function implode;
use function substr;

final class PartTwo
{
    use Shared;

    /** @var array<string, int> */
    protected array $sequences;

    /**
     * @param Generator<int, string> $input
     * @param int $nth
     *
     * @return int
     */
    public function __invoke(Generator $input, int $nth): int
    {
        $this->sequences = [];
        $this->numberCache = [];

        foreach ($input as $number) {
            $number = (int) $number;

            $this->determineSequences($number, $nth);
        }

        if (empty($this->sequences)) {
            throw new LogicException();
        }

        arsort($this->sequences);

        return array_shift($this->sequences);
    }

    protected function determineSequences(int $number, int $nth): void
    {
        $changes = [];
        $prize = (int) substr((string) $number, -1);

        $sequences = [];

        for ($i = 1; $i <= $nth; $i++) {
            $number = $this->calcNextNumber($number);

            $nextPrize = (int) substr((string) $number, -1);
            $changes[] = $nextPrize - $prize;

            if ($i > 3) {
                $sequenceKey = implode(' ', array_slice($changes, -4, 4));
                if (!isset($sequences[$sequenceKey])) {
                    $sequences[$sequenceKey] = $nextPrize;

                }
            }

            $prize = $nextPrize;
        }

        foreach ($sequences as $sequenceKey => $value) {
            $this->sequences[$sequenceKey] = ($this->sequences[$sequenceKey] ?? 0) + $value;
        }
    }

}
