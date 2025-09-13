<?php

declare(strict_types=1);

namespace AOC\Year2016\Day04;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartOne
{
    use Shared;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            if (!preg_match('/^(?<name>[a-z\-]+)-(?<id>\d+)\[(?<checksum>[a-z]+)]$/', trim($line), $m)) {
                continue;
            }

            [
                'name' => $encryptedName,
                'id' => $id,
                'checksum' => $checksum,
            ] = $m;

            if ($this->isRealRoom($encryptedName, $checksum)) {
                $count += (int) $id;
            }
        }

        return $count;
    }
}
