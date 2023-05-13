<?php
declare(strict_types=1);

namespace AOC\Year2015\Day13;

use AOC\Util\Pathfinding\MaxGraph;
use Generator;
use Safe\Exceptions\PcreException;
use function Safe\preg_match;

class PartOne
{
    /**
     * @param Generator<int, string, void, void> $input
     * @return int
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        $happiness = [];


        foreach ($input as $line) {
            if (preg_match('/(?P<P1>\w+) would (?P<gl>gain|lose) (?P<amount>\d+) happiness units by sitting next to (?P<P2>\w+)\./', $line, $m)) {
                $person1 = $m['P1'];
                $person2 = $m['P2'];
                $amount = (int) $m['amount'];
                if ($m['gl'] === 'lose') {
                    $amount *= -1;
                }


                $people = [$person1, $person2];
                sort($people);

                $key = implode('_', $people);

                if (isset($happiness[$key])) {
                    $happiness[$key] += $amount;
                } else {
                    $happiness[$key] = $amount;
                }
            }
        }

        $graph = new MaxGraph();

        $maxEdgeValue = 0;
        $start = '';

        foreach ($happiness as $people => $value) {
            [$person1, $person2] = explode('_', $people);

            $graph->addEdge($person1, $person2, $value);
            if ($value > $maxEdgeValue) {
                $maxEdgeValue = $value;
                $start = $person1;
            }
        }

        return $graph->maxCycle($start);
    }
}
