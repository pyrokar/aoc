<?php

declare(strict_types=1);

namespace AOC\Year2023\Day13;

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
                    if ($column === $lastColumn || $this->equalWithSmudge($lastColumn, $column)) {
                        $possibleReflectionColumns[] = $x - 1;
                    }
                    $lastColumn = $column;
                }

                foreach ($possibleReflectionColumns as $reflectionColumn) {
                    $smudge = false;
                    for ($i = 0; $i <= $reflectionColumn; ++$i) {
                        if (!isset($columns[$reflectionColumn + $i + 1])) {
                            if ($smudge) {
                                $countLines += $reflectionColumn + 1;
                                break 2;
                            }
                            continue 2;
                        }

                        if ($columns[$reflectionColumn - $i] !== $columns[$reflectionColumn + $i + 1]) {
                            if (!$smudge && $this->equalWithSmudge($columns[$reflectionColumn - $i], $columns[$reflectionColumn + $i + 1])) {
                                $smudge = true;
                            } else {
                                continue 2;
                            }
                        }
                    }

                    if ($smudge) {
                        $countLines += $reflectionColumn + 1;
                        break;
                    }
                }

                foreach ($possibleReflectionRows as $reflectionRow) {
                    $smudge = false;
                    for ($i = 0; $i <= $reflectionRow; ++$i) {
                        if (!isset($rows[$reflectionRow + $i + 1])) {
                            if ($smudge) {
                                $countLines += 100 * ($reflectionRow + 1);
                                break 2;
                            }
                            continue 2;
                        }

                        if ($rows[$reflectionRow - $i] !== $rows[$reflectionRow + $i + 1]) {
                            if (!$smudge && $this->equalWithSmudge($rows[$reflectionRow - $i], $rows[$reflectionRow + $i + 1])) {
                                $smudge = true;
                            } else {
                                continue 2;
                            }
                        }
                    }

                    if ($smudge) {
                        $countLines += 100 * ($reflectionRow + 1);
                        break;
                    }
                }

                $rows = [];
                $columns = [];

                $y = 0;

                $possibleReflectionRows = [];

                $lastLine = '';

                continue;
            }

            if ($lastLine === $line || $this->equalWithSmudge($lastLine, $line)) {
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

    private function equalWithSmudge(string $line1, string $line2): bool
    {
        $smudges = 0;
        for ($i = 0, $l = strlen($line1); $i < $l; ++$i) {
            if ($line1[$i] !== $line2[$i]) {
                ++$smudges;
            }
        }

        return $smudges === 1;
    }
}
