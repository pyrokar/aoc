<?php

declare(strict_types=1);

namespace AOC\Year2022\Day16;

use Generator;
use Safe\Exceptions\PcreException;

class PartOne
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init($input);

        Path::$totalMinutes = 30;

        $max = 0;

        $paths = [new Path(['H' => 'AA'])];

        /**
         * array<Path>
         */
        $newPaths = [];

        while (!empty($paths)) {
            foreach ($paths as $path) {
                [$currentValve, $minute] = $path->getCurrent('H');
                $minute = (int) $minute;

                foreach ($this->shortestPaths[$currentValve] as $next => $dist) {
                    if ($this->valves[$next]['flow'] === 0) {
                        continue;
                    }

                    if ($path->hasValve($next)) {
                        continue;
                    }

                    $nextMinute = $minute + $dist + 1;
                    if ($nextMinute > 30) {
                        continue;
                    }

                    $newPath = clone $path;
                    $newPath->openValve($next, $this->valves[$next]['flow'], $nextMinute);

                    if ($newPath->pressure < $max) {
                        unset($newPath);
                        continue;
                    }

                    $newPaths[] = $newPath;
                }
            }

            if (!empty($newPaths)) {
                uasort($newPaths, static fn(Path $p1, Path $p2) => $p2->pressure <=> $p1->pressure);

                $topPressure = current($newPaths)->pressure;
                if ($topPressure > $max) {
                    $max = $topPressure;
                }
            }

            $paths = $newPaths;
            $newPaths = [];
        }

        // AA->DD->DD@2->CC->BB->BB@5->AA->II->JJ->JJ@9->II->AA->DD->EE->FF->GG->HH->HH@17->GG->FF->EE->EE@21->DD->CC->CC@24

        return $max;
    }
}
