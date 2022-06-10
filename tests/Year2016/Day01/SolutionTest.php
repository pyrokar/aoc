<?php declare(strict_types=1);

namespace AOCTest\Year2016\Day01;

use AOC\Year2016\Day01\Solution;
use AOCTest\Util\TestUtil;
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
	use TestUtil;

	/** @var class-string */
	public static string $solutionClass = Solution::class;

	/**
	 * @return array<int, array<mixed>>
	 */
	public function partOneTestInput(): array
	{
		return [
			['R2, L3', 5],
			['R2, R2, R2', 2],
			['R5, L5, R5, R3', 12],
		];
	}

	/**
	 * @return array<int, array<mixed>>
	 */
	public function partTwoTestInput(): array
	{
		return [
			['R8, R4, R4, R8', 4],
		];
	}
}
