<?php declare(strict_types=1);

namespace AOC\Year2016\Day04;

use AOC\Util\SolutionInterface;
use AOC\Util\SolutionUtil;
use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;

class Solution implements SolutionInterface
{
    use SolutionUtil;

    /**
     * @param Generator<void, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function solvePartOne(Generator $input): int
    {
        $count = 0;
        foreach ($input as $line) {
            preg_match('/^(?<name>[a-z\-]+)-(?<id>\d+)\[(?<checksum>[a-z]+)]$/', trim($line), $m);

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

    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function solvePartTwo(Generator $input): int
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

    private function isRealRoom(string $encryptedName, string $checksum): bool
    {
        $chars = array_count_values(str_split($encryptedName));
        unset($chars['-']);

        uksort($chars, static function (string $k1, string $k2) use ($chars) {
            if ($chars[$k1] === $chars[$k2]) {
                return strcmp($k1, $k2);
            }

            return $chars[$k2] <=> $chars[$k1];
        });

        return implode('', array_keys(array_splice($chars, 0, 5))) === $checksum;
    }
}
