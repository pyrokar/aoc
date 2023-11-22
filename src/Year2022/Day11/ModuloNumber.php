<?php

declare(strict_types=1);

namespace AOC\Year2022\Day11;

class ModuloNumber
{
    /**
     * @var array<int>
     */
    private static array $divisors = [];

    /**
     * @var array<int>
     */
    private array $reminders = [];

    public function __construct(private readonly int $value) {}

    public function add(int $v): void
    {
        foreach (self::$divisors as $divisor) {
            $this->reminders[$divisor] = ($this->reminders[$divisor] + $v) % $divisor;
        }
    }

    public function mul(int $v): void
    {
        foreach (self::$divisors as $divisor) {
            $value = $divisor + $this->reminders[$divisor];
            $this->reminders[$divisor] = ($value * $v) % $divisor;
        }
    }

    public function square(): void
    {
        foreach (self::$divisors as $divisor) {
            $value = $this->reminders[$divisor] * $this->reminders[$divisor];
            $this->reminders[$divisor] = $value % $divisor;
        }
    }

    public static function addDivisor(int $divisor): void
    {
        self::$divisors[] = $divisor;
    }

    public static function clearDivisors(): void
    {
        self::$divisors = [];
    }

    public function updateReminders(): void
    {
        foreach (self::$divisors as $divisor) {
            $this->reminders[$divisor] = $this->value % $divisor;
        }
    }

    public function isDivisibleBy(int $divisor): bool
    {
        return isset($this->reminders[$divisor]) && $this->reminders[$divisor] === 0;
    }
}
