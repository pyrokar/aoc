<?php

declare(strict_types=1);

namespace AOC\Generator;

use AOCTest\Util\SolutionTestCase;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Override;
use Safe\Exceptions\DirException;
use Safe\Exceptions\FilesystemException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

use function is_file;
use function Safe\file_put_contents;
use function Safe\getcwd;
use function Safe\mkdir;

use const PHP_EOL;

#[AsCommand(name: 'generate')]
class GenerateCommand extends Command
{
    private string $year;

    private string $day;

    #[Override]
    public function getName(): string
    {
        return 'generate';
    }

    #[Override]
    protected function configure()
    {
        $this
            ->addArgument('year', InputArgument::REQUIRED)
            ->addArgument('day', InputArgument::REQUIRED)
        ;
    }

    /**
     * @throws DirException
     * @throws FilesystemException
     */
    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $validateYear = Validation::createCallable(
            new NotBlank(message: 'Year should not be blank'),
            new Regex(pattern: '/^\d{4}$/', message: 'Year should be exactly 4 digits'),
        );

        $validateDay = Validation::createCallable(
            new NotBlank(message: 'Day should not be blank'),
            new Regex(pattern: '/^\d{2}$/', message: 'Day should be exactly 2 digits'),
        );

        $this->year = (string) $validateYear($input->getArgument('year'));
        $this->day = (string) $validateDay($input->getArgument('day'));

        $output->writeln('Generating files for day ' . $this->day . ' in ' . $this->year);

        $cwd = getcwd();
        $pathDay = 'Year' . $this->year . DS . 'Day' . $this->day;

        $pathSrc = $cwd . DS . 'src' . DS . $pathDay;

        if (!is_dir($pathSrc)) {
            mkdir($pathSrc, 0755, true);
        }

        $pathTest = $cwd . DS . 'tests' . DS . $pathDay;

        if (!is_dir($pathTest)) {
            mkdir($pathTest, 0755, true);
        }

        $output->writeln($pathSrc);
        $output->writeln($pathTest);

        $this->generateFileOrIgnore($pathSrc . DS . 'PartOne.php', $this->generateSolutionClassFile(Part::One));
        $this->generateFileOrIgnore($pathSrc . DS . 'PartTwo.php', $this->generateSolutionClassFile(Part::Two));

        $this->generateFileOrIgnore($pathTest . DS . 'PartOneTest.php', $this->generateTestClassFile(Part::One));
        $this->generateFileOrIgnore($pathTest . DS . 'PartTwoTest.php', $this->generateTestClassFile(Part::Two));

        $this->generateFileOrIgnore($pathTest . DS . 'test', '');
        $this->generateFileOrIgnore($pathTest . DS . 'input', '');

        return Command::SUCCESS;
    }

    /**
     * @throws FilesystemException
     */
    private function generateFileOrIgnore(string $filename, string $content): void
    {
        if (is_file($filename)) {
            return;
        }

        file_put_contents($filename, $content);
    }

    private function generateSolutionClassFile(Part $part): string
    {
        $file = new PhpFile();
        $file->setStrictTypes();

        $file->addNamespace($this->generateSolutionClass($part));

        return (string) $file;
    }

    private function generateSolutionClass(Part $part): PhpNamespace
    {
        $namespace = new PhpNamespace('AOC\Year' . $this->year . '\Day' . $this->day);
        $namespace
            ->addUse('Generator')
        ;

        $solutionClass = new ClassType('Part' . $part->name);
        $solutionClass
            ->setFinal()
        ;

        $solutionClass->addMethod('__invoke')
            ->addComment('@param Generator<int, string> $input' . PHP_EOL)
            ->addComment('@return int')
            ->setReturnType('int')
            ->setBody(PHP_EOL . PHP_EOL . 'return 0;')
            ->addParameter('input')
                ->setType('Generator')
        ;

        $namespace->add($solutionClass);

        return $namespace;
    }

    private function generateTestClassFile(Part $part): string
    {
        $file = new PhpFile();
        $file->setStrictTypes();

        $file->addNamespace($this->generateTestClass($part));

        return (string) $file;
    }

    private function generateTestClass(Part $part): PhpNamespace
    {
        $namespace = new PhpNamespace('AOCTest\Year' . $this->year . '\Day' . $this->day);

        $namespace
            ->addUse('AOC\Year' . $this->year . '\Day' . $this->day . '\Part' . $part->name)
            ->addUse(SolutionTestCase::class)
            ->addUse(FilesystemException::class)
            ->addUse('Override')
        ;

        $testClass = new ClassType('Part' . $part->name . 'Test');
        $testClass
            ->setFinal()
            ->setExtends(SolutionTestCase::class)
            ->addProperty('solutionClass', new Literal('Part' . $part->name . '::class'))
                ->addComment('@var class-string')
                ->setType('string')
        ;

        $testClass->addMethod('data')
            ->addComment('@throws FilesystemException' . PHP_EOL)
            ->addComment('@return array<int, array<mixed>>')
            ->setReturnType('array')
            ->addAttribute('Override')
            ->addBody('return [')
            ->addBody('    [[$this->generatorFromFile(__DIR__ . DS . \'test\')], 0],')
            ->addBody('    [[$this->generatorFromFile(__DIR__ . DS . \'input\')], 0],')
            ->addBody('];')
        ;

        $namespace->add($testClass);

        return $namespace;
    }
}
