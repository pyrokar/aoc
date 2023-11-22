<?php

namespace AOC\Year2016\Day14;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

trait Solution
{
    /**
     * @param string $salt
     * @return int
     * @throws PcreException
     */
    public function __invoke(string $salt): int
    {
        $possibleKeys = [];
        $keysFound = 0;

        $keysFoundIndex = [];

        $regexTriplet = '/(?<char>.)\1\1/';

        $i = 0;

        while ($keysFound < 75) {
            $hash = $this->getHash($salt . $i);

            foreach ($possibleKeys as $index => $possibleKey) {
                if ($i > $possibleKey['i']) {
                    unset($possibleKeys[$index]);
                    continue;
                }

                if (str_contains($hash, $possibleKey['five'])) {
                    $tripleIndex = $possibleKey['i'] - 1000;
                    $keysFoundIndex[] = $tripleIndex;
                    ++$keysFound;
                    unset($possibleKeys[$index]);
                }
            }

            if (preg_match($regexTriplet, $hash, $m)) {
                $possibleKeys[] = ['five' => str_repeat($m['char'], 5), 'i' => $i + 1000];
            }

            ++$i;
        }

        sort($keysFoundIndex);

        return $keysFoundIndex[63];
    }
}
