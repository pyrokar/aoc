<?php

declare(strict_types=1);

namespace AOC\Year2023\Day13;

use Generator;

class PartOne
{
    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $countLines = 0;

        $rows = [];
        $columns = [];

        $y = 0;

        $possibleReflectionRows = [];

        $lastLine = '';

        foreach ($input as $line) {
            if ($line === '') {

                $lastColumn = '';
                $possibleReflectionColumns = [];

                foreach ($columns as $x => $column) {
                    if ($column === $lastColumn) {
                        $possibleReflectionColumns[] = $x - 1;
                    }

                    $lastColumn = $column;
                }

                foreach ($possibleReflectionColumns as $reflectionColumn) {
                    for ($i = 0; $i <= $reflectionColumn; ++$i) {
                        if (!isset($columns[$reflectionColumn + $i + 1])) {
                            $countLines += $reflectionColumn + 1;
                            break 2;
                        }

                        if ($columns[$reflectionColumn - $i] !== $columns[$reflectionColumn + $i + 1]) {
                            continue 2;
                        }
                    }

                    $countLines += ($reflectionColumn + 1);
                }

                foreach ($possibleReflectionRows as $reflectionRow) {
                    for ($i = 0; $i <= $reflectionRow; ++$i) {
                        if (!isset($rows[$reflectionRow + $i + 1])) {
                            $countLines += 100 * ($reflectionRow + 1);
                            break 2;
                        }

                        if ($rows[$reflectionRow - $i] !== $rows[$reflectionRow + $i + 1]) {
                            continue 2;
                        }
                    }

                    $countLines += 100 * ($reflectionRow + 1);
                }

                $rows = [];
                $columns = [];

                $y = 0;

                $possibleReflectionRows = [];

                $lastLine = '';

                continue;
            }

            if ($lastLine === $line) {
                $possibleReflectionRows[] = $y - 1;
            }

            $lastLine = $line;

            $rows[] = $line;
            ++$y;

            if (empty($columns)) {
                $columns = array_fill(0, strlen($line), '');
            }

            foreach (str_split($line) as $i => $char) {
                $columns[$i] .= $char;
            }
        }

        return $countLines;
    }
}
