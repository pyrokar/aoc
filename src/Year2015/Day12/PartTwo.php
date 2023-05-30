<?php

declare(strict_types=1);

namespace AOC\Year2015\Day12;

use Generator;

class PartTwo
{
    /**
     * @param Generator<int, string, void, void> $input
     *
     * @throws \JsonException
     *
     * @return int
     */
    public function __invoke(Generator $input): int
    {
        $json = json_decode($input->current(), false, 512, JSON_THROW_ON_ERROR);

        return $this->sumJson($json);
    }

    private function sumJson(mixed $json): int
    {
        $result = 0;

        if (is_numeric($json)) {
            return (int) $json;
        }

        if (is_array($json)) {
            foreach ($json as $value) {
                $result += $this->sumJson($value);
            }

            return $result;
        }

        if (is_object($json)) {
            $json = (array) $json;
            foreach ($json as $value) {
                if ($value === 'red') {
                    return 0;
                }

                $result += $this->sumJson($value);
            }

            return $result;
        }

        return $result;
    }
}
