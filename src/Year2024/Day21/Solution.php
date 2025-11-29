<?php

declare(strict_types=1);

namespace AOC\Year2024\Day21;

use AOC\Util\Set;
use Generator;

use function implode;
use function str_repeat;
use function str_split;
use function strlen;

use const PHP_INT_MAX;

/**
 * @phpstan-type Position array{int, int}
 */
final class Solution
{
    private int $robots;

    /** @var array<string, string> */
    private array $sequenceCache;

    /** @var array<int, array<string, int>> */
    private array $dirPadCache;

    /**
     * @param Generator<int, string> $input
     * @param int $robots
     *
     * @return int
     */
    public function __invoke(Generator $input, int $robots = 2): int
    {
        $sum = 0;

        $this->robots = $robots;

        $this->dirPadCache = [];
        $this->sequenceCache = [];

        foreach ($input as $line) {
            $length = $this->findShortestSequence($line);
            $number = (int) $line;

            $sum += $number * $length;
        }

        return $sum;
    }

    private function findShortestSequence(string $line): int
    {
        $startButton = 'A';
        $length = 0;

        foreach (str_split($line) as $char) {
            $length += $this->getNumPadSeqLength($startButton, $char);
            $startButton = $char;
        }

        return $length;
    }

    private function getNumPadSeqLength(string $start, string $end): int
    {
        $startPos = $this->getNumPadPosition($start);
        $endPos = $this->getNumPadPosition($end);

        $sequence = $this->getSequence($startPos, $endPos);

        /** @var Set<string> $set */
        $set = new Set(str_split($sequence));

        $length = PHP_INT_MAX;

        foreach ($set->getPermutations() as $curSequence) {
            if ($this->isNumPadSeqForbidden($startPos, implode('', $curSequence))) {
                continue;
            }

            $curLength = 0;

            $startButton = 'A';
            /** @var string $nextButton */
            foreach ($curSequence as $nextButton) {
                $curLength += $this->getDirPadSeqLength($startButton, $nextButton);

                $startButton = $nextButton;
            }

            $curLength += $this->getDirPadSeqLength($startButton, 'A');

            if ($curLength < $length) {
                $length = $curLength;
            }
        }

        return $length;

    }

    private function getDirPadSeqLength(string $start, string $end, int $robot = 1): int
    {
        if ($start === $end) {
            return 1;
        }

        $cacheKey = $start . '_' . $end;

        if (isset($this->dirPadCache[$robot][$cacheKey])) {
            return $this->dirPadCache[$robot][$cacheKey];
        }

        $startPos = $this->getDirPadPosition($start);
        $endPos = $this->getDirPadPosition($end);

        $sequence = $this->getSequence($startPos, $endPos);

        /** @var Set<string> $set */
        $set = new Set(str_split($sequence));

        $length = PHP_INT_MAX;

        foreach ($set->getPermutations() as $curSequence) {
            if ($this->isDirPadSeqForbidden($startPos, implode('', $curSequence))) {
                continue;
            }

            if ($robot < $this->robots) {
                $curLength = 0;
                $startButton1 = 'A';

                /** @var string $char */
                foreach ($curSequence as $char) {
                    $curLength += $this->getDirPadSeqLength($startButton1, $char, $robot + 1);
                    $startButton1 = $char;
                }

                $curLength += $this->getDirPadSeqLength($startButton1, 'A', $robot + 1);
            } else {
                $curLength = strlen($sequence) + 1;
            }

            if ($curLength < $length) {
                $length = $curLength;
            }
        }

        $this->dirPadCache[$robot][$cacheKey] = $length;

        return $length;
    }

    /**
     * @param Position $startPos
     * @param Position $endPos
     *
     * @return string
     */
    private function getSequence(array $startPos, array $endPos): string
    {
        $cacheKey = implode('_', $startPos) . '_' . implode('_', $endPos);

        if (isset($this->sequenceCache[$cacheKey])) {
            return $this->sequenceCache[$cacheKey];
        }

        $sequence = '';
        if ($startPos[1] < $endPos[1]) {
            $sequence .= str_repeat('v', $endPos[1] - $startPos[1]);

            if ($startPos[0] < $endPos[0]) {
                $sequence .= str_repeat('>', $endPos[0] - $startPos[0]);
            } else {
                $sequence .= str_repeat('<', $startPos[0] - $endPos[0]);
            }
        } else {
            if ($startPos[0] < $endPos[0]) {
                $sequence .= str_repeat('>', $endPos[0] - $startPos[0]);
            } else {
                $sequence .= str_repeat('<', $startPos[0] - $endPos[0]);
            }

            $sequence .= str_repeat('^', $startPos[1] - $endPos[1]);
        }

        $this->sequenceCache[$cacheKey] = $sequence;

        return $sequence;
    }

    /**
     * @param Position $startPos
     * @param string $sequence
     *
     * @return bool
     */
    private function isNumPadSeqForbidden(array $startPos, string $sequence): bool
    {
        return match (implode('_', $startPos)) {
            '0_0' => str_starts_with($sequence, 'vvv'),
            '0_1' => str_starts_with($sequence, 'vv'),
            '0_2' => str_starts_with($sequence, 'v'),
            '1_3' => str_starts_with($sequence, '<'),
            '2_3' => str_starts_with($sequence, '<<'),
            default => false,
        };

    }

    /**
     * @param Position $startPos
     * @param string $sequence
     *
     * @return bool
     */
    private function isDirPadSeqForbidden(array $startPos, string $sequence): bool
    {
        return match (implode('_', $startPos)) {
            '1_0' => str_starts_with($sequence, '<'),
            '2_0' => str_starts_with($sequence, '<<'),
            '0_1' => str_starts_with($sequence, '^'),
            default => false,
        };
    }

    /**
     * @param string $button
     *
     * @return Position
     */
    private function getNumPadPosition(string $button): array
    {
        static $numPadPositions = [
            '7' => [0, 0],
            '8' => [1, 0],
            '9' => [2, 0],
            '4' => [0, 1],
            '5' => [1, 1],
            '6' => [2, 1],
            '1' => [0, 2],
            '2' => [1, 2],
            '3' => [2, 2],
            '0' => [1, 3],
            'A' => [2, 3],
        ];

        return $numPadPositions[$button];
    }

    /**
     * @param string $button
     *
     * @return Position
     */
    private function getDirPadPosition(string $button): array
    {
        static $dirPadPositions = [
            '^' => [1, 0],
            'A' => [2, 0],
            '<' => [0, 1],
            'v' => [1, 1],
            '>' => [2, 1],
        ];

        return $dirPadPositions[$button];
    }

}
