<?php

namespace AOC\Year2022\Day16;

class Path
{
    public static int $totalMinutes = 0;

    public array $positions = [];

    /**
     * @var array<string, int>
     */
    public array $openValves = [];

    public int $pressure = 0;

    public function __construct(array $startPositions)
    {
        $this->positions = $startPositions;
        $this->openValves['AA'] = 0;
    }

    public function hasValve(string $valve): bool
    {
        return isset($this->openValves[$valve]);
    }

    public function openValve(string $valve, int $flow, int $minute, string $player = 'H'): void
    {
        $this->positions[$player] = $valve;
        $this->openValves[$valve] = $minute;
        $this->pressure += $flow * (self::$totalMinutes - $minute);
    }

    /**
     * @param string $player
     * @return array{string, int}
     */
    public function getCurrent(string $player): array
    {
        $position = $this->positions[$player];
        return [$position, $this->openValves[$position] ?? 0];
    }


}
