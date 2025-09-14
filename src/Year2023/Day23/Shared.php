<?php

declare(strict_types=1);

namespace AOC\Year2023\Day23;

use AOC\Util\CompassDirection;
use AOC\Util\Graph\Graph;
use AOC\Util\Position2D;
use DomainException;
use Generator;
use SplQueue;

trait Shared
{
    /**
     * @var array<string, string>
     */
    protected array $grid;

    protected string $target;

    protected Graph $graph;

    protected int $maxEndDistance;

    /**
     * @param Generator<int, string> $input
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        Position2D::invertY();

        $this->grid = [];
        $this->maxEndDistance = 0;
        $width = 0;
        $height = 0;

        $source = null;

        foreach ($input as $y => $line) {
            foreach (str_split($line) as $x => $char) {
                if ($char === '#') {
                    continue;
                }

                $this->addPosition($x, $y, $char);

                if ($y === 0) {
                    $source = new Position2D($x, 0);
                }
            }

            $width = strlen($line);
            $height++;
        }

        for ($x = 0; $x < $width; ++$x) {
            if (isset($this->grid[Position2D::key($x, $height - 1)])) {
                $this->target = Position2D::key($x, $height - 1);
            }
        }

        if (!$source || !$this->target) {
            throw new DomainException('No source or target found!');
        }

        $this->graph = $this->buildGraph($source);

        $this->findMaxPath($source->getKey(), [], [$source->getKey() => 0]);

        return $this->maxEndDistance;
    }

    /**
     * @param Position2D $node
     * @param array<string, int> $excludes
     *
     * @return array<Position2D>
     */
    protected function getSuccessors(Position2D $node, array $excludes): array
    {
        static $slopes = [
            CompassDirection::North->value => '^',
            CompassDirection::East->value => '>',
            CompassDirection::South->value => 'v',
            CompassDirection::West->value => '<',
        ];

        $successors = [];

        foreach ($node->getOrthogonalNeighbors() as $dir => $neighbor) {
            if (!isset($this->grid[$neighbor->getKey()])) {
                continue;
            }

            if (isset($excludes[$neighbor->getKey()])) {
                continue;
            }

            $neighborChar = $this->grid[$neighbor->getKey()];
            if ($neighborChar !== '.' && $neighborChar !== $slopes[$dir]) {
                continue;
            }

            $successors[] = $neighbor;
        }

        return $successors;
    }

    protected function buildGraph(Position2D $source): Graph
    {
        $sourceKey = $source->getKey();

        $parents = [$sourceKey => $sourceKey];
        $predecessors = [$sourceKey => ''];
        $distances = [$sourceKey => 0];
        $hadSlope = [$sourceKey => false];

        $graph = new Graph();

        /** @var SplQueue<Position2D> $frontier */
        $frontier = new SplQueue();
        $frontier->enqueue($source);

        while (!$frontier->isEmpty()) {
            $node = $frontier->dequeue();
            $nodeKey = $node->getKey();

            if ($nodeKey === $this->target) {
                if ($hadSlope[$nodeKey]) {
                    $graph->addEdge($parents[$nodeKey], $nodeKey, $distances[$nodeKey]);
                } else {
                    $graph->addUndirectedEdge($nodeKey, $parents[$nodeKey], $distances[$nodeKey]);
                }

                continue;
            }

            $successors = $this->getSuccessors($node, [$predecessors[$nodeKey] => 1]);

            if (count($successors) === 0) {
                continue;
            }

            if (count($successors) === 1) {
                $successor = $successors[0];
                $successorKey = $successor->getKey();

                $parents[$successorKey] = $parents[$nodeKey];
                $predecessors[$successorKey] = $nodeKey;
                $distances[$successorKey] = $distances[$nodeKey] + 1;
                $hadSlope[$successorKey] = $hadSlope[$nodeKey] || $this->grid[$successorKey] !== '.';

                $frontier->enqueue($successor);
                continue;
            }

            if ($graph->hasVertex($nodeKey)) {
                if ($hadSlope[$nodeKey]) {
                    $graph->addEdge($parents[$nodeKey], $nodeKey, $distances[$nodeKey]);
                } else {
                    $graph->addUndirectedEdge($nodeKey, $parents[$nodeKey], $distances[$nodeKey]);
                }

                $hadSlope[$nodeKey] = false;
                continue;
            }

            if ($hadSlope[$nodeKey]) {
                $graph->addEdge($parents[$nodeKey], $nodeKey, $distances[$nodeKey]);
            } else {
                $graph->addUndirectedEdge($nodeKey, $parents[$nodeKey], $distances[$nodeKey]);
            }

            $hadSlope[$nodeKey] = false;

            foreach ($successors as $successor) {
                $successorKey = $successor->getKey();

                $parents[$successorKey] = $nodeKey;
                $predecessors[$successorKey] = $nodeKey;
                $distances[$successorKey] = 1;
                $hadSlope[$successorKey] = $this->grid[$successorKey] !== '.';

                $frontier->enqueue($successor);
            }

        }

        return $graph;
    }

    /**
     * @param string $source
     * @param array<string, int> $path
     * @param array<string, int> $distances
     *
     * @return void
     */
    protected function findMaxPath(string $source, array $path, array $distances = []): void
    {
        if ($source === $this->target) {
            $this->maxEndDistance = max($this->maxEndDistance, $distances[$source]);
            return;
        }

        $path[$source] = 1;

        $distance = $distances[$source];

        foreach ($this->graph->getNeighbors($source) as $successorKey => $dist) {

            if (isset($path[$successorKey])) {
                continue;
            }

            if (!isset($distances[$successorKey])) {
                $newDistances = $distances;
                $newDistances[$successorKey] = $distance + $dist;
                $this->findMaxPath($successorKey, $path, $newDistances);
            }
        }
    }

    abstract protected function addPosition(int $x, int $y, string $char): void;
}
