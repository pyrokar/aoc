<?php

declare(strict_types=1);

namespace AOC\Util\Pathfinding;

class MinGraph
{
    /**
     * @var array<string, array<string, int>>
     */
    private array $adjacencyList = [];

    /**
     * @var array<int, array<string, int>>
     */
    private array $cost = [];

    /**
     * @param non-empty-string $sep
     */
    public function __construct(private readonly string $sep = '_') {}

    public function addVertex(string $vertex): void
    {
        if (!isset($this->adjacencyList[$vertex])) {
            $this->adjacencyList[$vertex] = [];
        }
    }

    public function addEdge(string $from, string $to, int $value = 1): void
    {
        $this->addVertex($from);
        $this->adjacencyList[$from][$to] = $value;

        $this->addVertex($to);
        $this->adjacencyList[$to][$from] = $value;
    }

    /**
     * @param string|null $start
     *
     * @return int
     */
    public function minPath(string $start = null): int
    {
        $count = count($this->adjacencyList);

        if (!$start) {
            $start = array_key_first($this->adjacencyList);
        }

        foreach ($this->adjacencyList[$start] as $second => $value) {
            $this->cost[0][$start . $this->sep . $second] = $value;
        }

        for ($i = 1; $i < $count; $i++) {
            foreach ($this->cost[$i - 1] as $pathKey => $v) {

                $path = explode($this->sep, $pathKey);

                foreach ($this->adjacencyList[reset($path)] as $third => $value) {
                    if (in_array($third, $path, true)) {
                        continue;
                    }

                    $cost = $this->cost[$i - 1][$pathKey] + $value;
                    $this->cost[$i][$third . $this->sep . $pathKey] = $cost;
                }

                foreach ($this->adjacencyList[end($path)] as $third => $value) {
                    if (in_array($third, $path, true)) {
                        continue;
                    }

                    $cost = $this->cost[$i - 1][$pathKey] + $value;
                    $this->cost[$i][$pathKey . $this->sep . $third] = $cost;
                }
            }
        }

        return min($this->cost[$count - 2]);
    }
}
