<?php

declare(strict_types=1);

namespace AOC\Year2016\Day04;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        foreach ($input as $line) {
            preg_match('/^(?<name>[a-z\-]+)-(?<id>\d+)\[(?<checksum>[a-z]+)]$/', trim($line), $m);

            [
                'name' => $encryptedName,
                'id' => $id,
                'checksum' => $checksum,
            ] = $m;

            if (!$this->isRealRoom($encryptedName, $checksum)) {
                continue;
            }

            $decryptedName = str_rot($encryptedName, (int) $id);

            if ($decryptedName === 'northpole-object-storage') {
                return (int) $id;
            }
        }

        return 0;
    }
}
