<?php

declare(strict_types=1);

namespace AOC\Year2025\Day11;

use Generator;
use Safe\Exceptions\PcreException;

final class PartTwo
{
    use Shared;

    /**
     * @param Generator<int, string> $input
     *
     * @throws PcreException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $this->init($input);

        $dac_fft = $this->findPaths('dac', 'fft');

        if ($dac_fft === 0) {
            $srv_fft = $this->findPaths('svr', 'fft');
            $fft_dac = $this->findPaths('fft', 'dac');
            $dac_out = $this->findPaths('dac', 'out');

            return $srv_fft * $fft_dac * $dac_out;
        }

        $srv_dac = $this->findPaths('svr', 'dac');
        $fft_out = $this->findPaths('fft', 'out');

        return $srv_dac * $dac_fft * $fft_out;
    }

}
