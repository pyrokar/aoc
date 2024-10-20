<?php

declare(strict_types=1);

namespace AOC\Util\Graph;

use Generator;

/**
 * @phpstan-type Edge array{string, string, int}
 */
final class Graph
{
    /**
     * @var array<string, array<string, int>>
     */
    private array $adjacentList;

    public function __construct()
    {
        $this->adjacentList = [];
    }

    public function addVertex(string $vertex): void
    {
        if (!isset($this->adjacentList[$vertex])) {
            $this->adjacentList[$vertex] = [];
        }
    }

    public function hasVertex(string $vertex): bool
    {
        return isset($this->adjacentList[$vertex]);
    }

    /**
     * @return list<string>
     */
    public function getVertices(): array
    {
        return array_keys($this->adjacentList);
    }

    /**
     * @param string $source
     *
     * @return array<string, int>
     */
    public function getNeighbors(string $source): array
    {
        return $this->adjacentList[$source];
    }

    public function addEdge(string $source, string $target, int $weight = 1): void
    {
        $this->addVertex($source);
        $this->addVertex($target);

        $this->adjacentList[$source][$target] = $weight;
    }

    public function addUndirectedEdge(string $source, string $target, int $weight = 1): void
    {
        $this->addVertex($source);
        $this->addVertex($target);

        $this->adjacentList[$source][$target] = $weight;
        $this->adjacentList[$target][$source] = $weight;
    }

    /**
     * @return Generator<Edge>
     */
    public function getEdges(): Generator
    {
        foreach ($this->adjacentList as $v => $neighbors) {
            foreach ($neighbors as $neighbor => $weight) {
                yield [$v, $neighbor, $weight];
            }
        }
    }

    public function getWeight(string $source, string $target): int
    {
        return $this->adjacentList[$source][$target];
    }

    public function getInvertedWeightGraph(): self
    {
        $graph = new self();

        foreach ($this->adjacentList as $source => $neighbors) {
            foreach ($neighbors as $target => $weight) {
                $graph->addEdge($source, $target, -1 * $weight);
            }
        }

        return $graph;
    }

}
