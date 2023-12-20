<?php

declare(strict_types=1);

namespace AOC\Year2023\Day19;

use Generator;

use Safe\Exceptions\PcreException;

use function array_reduce;
use function array_sum;
use function explode;
use function Safe\preg_match;

/**
 * @phpstan-type Rating array{x: int, m: int, a: int, s: int}
 */
class PartOne
{
    use Shared;

    /** @var array<Rating> */
    private array $partRatings;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->partRatings = [];
        $this->acceptedRanges = [];

        foreach ($input as $line) {
            $this->extractWorkflow($line);
            $this->extractPartRatings($line);
        }

        $this->findAcceptedRanges();

        $sum = 0;

        foreach ($this->partRatings as $partRating) {
            if ($this->isPartRatingAccepted($partRating)) {
                $sum += array_sum($partRating);
            }
        }

        return $sum;
    }

    /**
     * @throws PcreException
     */
    private function extractPartRatings(string $line): void
    {
        if (!preg_match('/^\{(?<obj>.*)}$/', $line, $m)) {
            return;
        }

        $partRating = array_reduce(explode(',', $m['obj']), static function ($arr, $p) {
            [$k, $v] = explode('=', $p);
            $arr[$k] = (int) $v;
            return $arr;
        }, []);

        $this->partRatings[] = $partRating;
    }

    /**
     * @param Rating $partRating
     *
     * @return bool
     */
    private function isPartRatingAccepted(array $partRating): bool
    {
        foreach ($this->acceptedRanges as $acceptedRange) {
            foreach (['x', 'm', 'a', 's'] as $category) {
                if ($partRating[$category] < $acceptedRange[$category][0]) {
                    continue 2;
                }
                if ($partRating[$category] >= $acceptedRange[$category][1]) {
                    continue 2;
                }
            }

            return true;
        }

        return false;
    }
}
