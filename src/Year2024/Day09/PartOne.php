<?php

declare(strict_types=1);

namespace AOC\Year2024\Day09;

use function array_map;
use function count;
use function str_split;

final class PartOne
{
    use Shared;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $a = array_map(intval(...), str_split($input));

        $checksum = 0;
        $position = 0;
        $l = count($a);

        $lastFileBlockIndex = $l - 1;

        for ($i = 0; $i < $l; $i++) {
            if (!isset($a[$i])) {
                break;
            }

            if ($i % 2 === 0) {
                // file block
                $blockId = (int) ($i / 2);
                $blockLength = $a[$i];

                $blockCheckSum = $this->calcBlockChecksum($blockId, $blockLength, $position);

                $checksum += $blockCheckSum;

                $position += $a[$i];
            } else {
                $spaceLength = $a[$i];

                while ($spaceLength > 0) {
                    $lastBlockLength = $a[$lastFileBlockIndex];
                    $lastBlockId = $lastFileBlockIndex / 2;

                    if ($lastBlockLength <= $spaceLength) {
                        $blockCheckSum = $this->calcBlockChecksum($lastBlockId, $lastBlockLength, $position);
                        $checksum += $blockCheckSum;

                        unset($a[$lastFileBlockIndex], $a[$lastFileBlockIndex - 1]);

                        $lastFileBlockIndex -= 2;
                        $spaceLength -= $lastBlockLength;
                        $position += $lastBlockLength;
                    } else {
                        // last block doesnt fit into space
                        $blockCheckSum = $this->calcBlockChecksum($lastBlockId, $spaceLength, $position);
                        $checksum += $blockCheckSum;

                        $a[$lastFileBlockIndex] = $lastBlockLength - $spaceLength;
                        $position += $spaceLength;
                        $spaceLength = 0;

                    }
                }
            }

        }

        return $checksum;
    }
}
