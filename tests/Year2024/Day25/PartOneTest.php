<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day25;

use AOC\Year2024\Day25\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

final class PartOneTest extends SolutionTestCase
{
	/** @var class-string */
	public string $solutionClass = PartOne::class;


	/**
	 * @throws FilesystemException
	 *
	 * @return array<int, array<mixed>>
	 */
	#[Override]
	public function data(): array
	{
		return [
		    [[$this->generatorFromFile(__DIR__ . DS . 'test')], 3],
		    [[$this->generatorFromFile(__DIR__ . DS . 'input')], 3483],
		];
	}
}
