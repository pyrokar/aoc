<?php

declare(strict_types=1);

namespace AOC\Year2024\Day09;

use function array_map;
use function count;
use function str_split;

final class PartTwo
{
    use Shared;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $a = array_map('intval', str_split($input));

        $checksum = 0;

        $blocks = [];
        $spaces = [];

        $currentPosition = 0;
        $l = count($a);

        for ($i = 0; $i < $l; $i++) {
            if ($i % 2 === 0) {
                $blockId = (int) ($i / 2);
                $blocks[$currentPosition] = ['id' => $blockId, 'l' => $a[$i], 'p' => $currentPosition];
            } else {
                if ($a[$i] === 0) {
                    continue;
                }
                $spaces[$currentPosition] = ['l' => $a[$i], 'p' => $currentPosition];
            }
            $currentPosition += $a[$i];
        }

        $blocksR = array_reverse($blocks);

        foreach ($blocksR as $block) {
            // search free space
            ksort($spaces);

            foreach ($spaces as $spacePos => $space) {
                if ($spacePos > $block['p']) {
                    continue 2;
                }

                if ($block['l'] <= $space['l']) {
                    // free space found
                    unset($blocks[$block['p']]);
                    $block['p'] = $spacePos;
                    $blocks[$spacePos] = $block;

                    unset($spaces[$spacePos]);
                    $restSpace = $space['l'] - $block['l'];
                    if ($restSpace > 0) {
                        $spaces[$spacePos + $block['l']] = ['l' => $restSpace, 'p' => $spacePos + $block['l']];
                    }
                    continue 2;
                }
            }
        }

        foreach ($blocks as $block) {
            $checksum += $this->calcBlockChecksum($block['id'], $block['l'], $block['p']);
        }

        return $checksum;
    }
}
