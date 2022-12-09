<?php declare(strict_types=1);

namespace AOC\Year2022\Day09;

use AOC\Util\CompassDirection;
use Generator;

use Safe\Exceptions\PcreException;
use function Safe\preg_match;

class PartTwo
{

    /**
     * @param Generator<void, string, void, void> $input
     * @return int
     * @throws PcreException
     */
    public function __invoke(Generator $input): int
    {
        $tailPath = [];

        $rope = new Rope(10);

        /** @var array<string, CompassDirection> $directionMap */
        $directionMap = [
            'U' => CompassDirection::North,
            'R' => CompassDirection::East,
            'D' => CompassDirection::South,
            'L' => CompassDirection::West,
        ];

        $tailPath[$rope->getTail()->getKey()] = 1;

        foreach ($input as $line) {
            if (!preg_match('/(?<dir>[RULD]) (?<amount>\d+)/', $line, $m)) {
                continue;
            }

//            echo '== ' . $line . ' ==' . PHP_EOL;

            $dir = $directionMap[$m['dir']];
            $amount = (int) $m['amount'];

            for ($i = 0; $i < $amount; $i++) {

                $rope->moveHead($dir);

                $key = $rope->getTail()->getKey();

                if (!isset($tailPath[$key])) {
                    $tailPath[$key] = 1;
                }

                //$rope->printPath();
            }

        }

        return count($tailPath);
    }
}
