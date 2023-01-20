<?php

namespace AOC\Year2022\Day16;

use AOC\Util\ShortestPath\AStar;
use Generator;

trait Shared
{
    /**
     * @var array<string, array<string, int>>
     */
    protected array $shortestPaths;
    /**
     * @var array<string, array{flow: int, valves: array<string>}>
     */
    protected array $valves;

    /**
     * @param Generator<int, string> $input
     * @return void
     */
    protected function init(Generator $input): void
    {
        $this->valves = [];
        $this->shortestPaths = ['AA' => []];

        foreach ($input as $line) {
            if (!preg_match('/Valve (?<valve>\w{2}) has flow rate=(?<flow>\d+); tunnel[s]? lead[s]? to valve[s]? (?<valves>.*)/', $line, $nextMinute)) {
                continue;
            }

            $valve = (string)$nextMinute['valve'];
            $flow = (int)$nextMinute['flow'];
            $valves = explode(', ', $nextMinute['valves']);

            $this->valves[$valve] = ['flow' => $flow, 'valves' => $valves];
        }

        $astar = new AStar(function ($start) {
            return $this->valves[$start]['valves'];
        }, function () {
            return 1;
        });

        foreach ($this->valves as $start => $a) {
            $this->shortestPaths[$start] = [];

            foreach ($this->valves as $end => $b) {
                if ($start === $end) {
                    continue;
                }

                if (in_array($end, $a['valves'], true)) {
                    $this->shortestPaths[$start][$end] = 1;
                } else {
                    $this->shortestPaths[$start][$end] = $astar->findMinDistance($start, $end);
                }
            }
        }
    }
}
