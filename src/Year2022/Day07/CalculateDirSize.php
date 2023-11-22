<?php

declare(strict_types=1);

namespace AOC\Year2022\Day07;

use Generator;
use Safe\Exceptions\PcreException;

use function Safe\preg_match;
use function Safe\preg_replace;

trait CalculateDirSize
{
    /**
     * @param Generator<string> $input
     *
     * @throws PcreException
     *
     * @return array<string, int>
     */
    protected function calculateDirSize(Generator $input): array
    {
        $ls = [];
        $cwd = '';

        foreach ($input as $line) {
            if (preg_match('/\$ cd (?<dir>.*)/', $line, $m)) {
                $dir = $m['dir'];

                switch ($dir) {
                    case '/':
                        $cwd = '/';
                        break;
                    case '..':
                        $cwd = preg_replace('/(.*)\/[^\/]+$/', '$1', $cwd);
                        break;
                    default:
                        $cwd .= ($cwd === '/') ? $dir : '/' . $dir;
                }
                continue;
            }

            if ($line === '$ ls') {
                continue;
            }

            if (!isset($ls[$cwd])) {
                $ls[$cwd] = [];
            }

            if (preg_match('/dir (?<dir>.*)/', $line, $m)) {
                $dir = $m['dir'];
                $ls[$cwd][] = new Dir(($cwd === '/') ? $cwd . $dir : $cwd . '/' . $dir);
            }

            if (preg_match('/(?<size>\d+) .*/', $line, $m)) {
                $size = (int) $m['size'];
                $ls[$cwd][] = new File($size);
            }
        }

        $dirSizes = [];

        foreach ($ls as $dir => $content) {
            $dirSizes[$dir] = $this->totalSize($content, $ls);
        }

        return $dirSizes;
    }

    /**
     * @param array<File|Dir> $dir
     * @param array<string, array<File|Dir>> $dirs
     *
     * @return int
     */
    private function totalSize(array $dir, array $dirs): int
    {
        $size = 0;
        foreach ($dir as $entry) {
            $size += $entry instanceof File ? $entry->size : $this->totalSize($dirs[$entry->name], $dirs);
        }
        return $size;
    }
}

class File
{
    public function __construct(
        public readonly int $size,
    ) {}

}

class Dir
{
    public function __construct(
        public readonly string $name
    ) {}

}
