<?php

declare(strict_types=1);

namespace AOC\Year2023\Day10;

use AOC\Util\CompassDirection;
use AOC\Util\Position2D;
use Exception;
use Generator;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws Exception
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        $width = 0;
        $height = 0;

        $grid = [];
        $start = '';

        foreach ($input as $y => $line) {
            $height++;
            $width = strlen($line);
            foreach (str_split($line) as $x => $char) {
                $key = Position2D::key($x, $y);
                $grid[$key] = $char;
                if ($char === 'S') {
                    $start = $key;
                }
            }
        }

        $positions = [];
        $directions = [];

        foreach (CompassDirection::cases() as $dir) {
            try {
                [$direction, $position] = $this->getNextPosition($dir, Position2D::fromKey($start), $grid);
            } catch (Exception) {
                continue;
            }

            if (!$direction) {
                continue;
            }

            $directions[] = $dir->value;
            $positions[] = $position;
        }

        $s = match (true) {
            ($directions === ['n', 'e'] || $directions === ['e', 'n']) => 'L',
            ($directions === ['e', 's'] || $directions === ['s', 'e']) => 'F',
            ($directions === ['s', 'w'] || $directions === ['w', 's']) => '7',
            ($directions === ['w', 'n'] || $directions === ['n', 'w']) => 'J',
            default => 'S'
        };

        $grid[$start] = $s;
        $direction = CompassDirection::from($directions[0]);
        $position = Position2D::fromKey($start);

        /**
         * @var CompassDirection $direction
         * @var Position2D $position
         */

        $loop = [$start => 1];
        [$direction, $position] = $this->getNextPosition($direction, $position, $grid);

        while (!isset($loop[$position->getKey()])) {
            $loop[$position->getKey()] = 1;
            [$direction, $position] = $this->getNextPosition($direction, $position, $grid);
        }

        $enclosed = 0;
        $within = false;

        for ($y = 1; $y < $height - 1; ++$y) {
            $lastLineBeginn = '';
            for ($x = 0; $x < $width; ++$x) {
                $key = Position2D::key($x, $y);
                $char = $grid[$key];
                if ($within) {
                    if (!isset($loop[$key])) {
                        ++$enclosed;
                    } elseif ($char === '|') {
                        $within = false;
                    } elseif ($lastLineBeginn === '') {
                        $lastLineBeginn = $char;
                    } elseif (($lastLineBeginn === 'F' && $char === 'J') || ($lastLineBeginn === 'L' && $char === '7')) {
                        $within = false;
                        $lastLineBeginn = '';
                    } elseif ($char !== '-') {
                        $lastLineBeginn = '';
                    }
                } else {
                    if (isset($loop[$key])) {
                        if ($char === '|') {
                            $within  = true;
                        } elseif ($lastLineBeginn === '') {
                            $lastLineBeginn = $char;
                        } elseif (($lastLineBeginn === 'F' && $char === 'J') || ($lastLineBeginn === 'L' && $char === '7')) {
                            $within = true;
                            $lastLineBeginn = '';
                        } elseif ($char !== '-') {
                            $lastLineBeginn = '';
                        }
                    }
                }
            }
        }

        return $enclosed;
    }
}
