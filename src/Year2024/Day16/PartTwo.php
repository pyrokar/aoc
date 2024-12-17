<?php

declare(strict_types=1);

namespace AOC\Year2024\Day16;

use Generator;
use Safe\Exceptions\ArrayException;
use SplStack;

use function Safe\array_replace;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws ArrayException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {

        $this->init($input);

        $cost = $this->shortestPath();

        $paths = $this->findPaths($cost);

        return count($paths);
    }

    /**
     * @throws ArrayException
     *
     * @return array<string, int>
     */
    private function findPaths(int $cost): array
    {
        $paths = [];

        $globalCostSoFar = [];

        $stack = new SplStack();
        $stack->push([$this->start, 0, [$this->start->getKey() => 0]]);

        while (!$stack->isEmpty()) {
            [$current, $costSoFar, $path] = $stack->shift();

            foreach ($this->getNeighbors($current) as [$next, $nextCost]) {
                if (isset($path[$next->getKey()])) {
                    continue;
                }

                if (isset($globalCostSoFar[$next->getKey()]) && $globalCostSoFar[$next->getKey()] < $costSoFar + $nextCost - 1000) {
                    continue;
                }

                if ($costSoFar + $nextCost > $cost) {
                    continue;
                }

                if ($next->getKey() === $this->end->getKey()) {
                    $path[$this->end->getKey()] = 1;
                    $paths = array_replace($paths, $path);
                    break;
                }

                $globalCostSoFar[$next->getKey()] = $costSoFar + $nextCost;

                $stack->push([$next, $costSoFar + $nextCost, [...$path, ...[$next->getKey() => 1]]]);
            }
        }

        return $paths;
    }
}
