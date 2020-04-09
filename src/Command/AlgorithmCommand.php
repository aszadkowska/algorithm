<?php

namespace App\Command;

use App\Service\AlgorithmService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AlgorithmCommand extends Command
{
    protected static $defaultName = 'algorithm:maxValue';

    /** @var AlgorithmService */
    private $algorithmService;

    public function __construct(AlgorithmService $algorithmService)
    {
        parent::__construct();
        $this->algorithmService = $algorithmService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Calculating the maximum value in a numeric string')
            ->addArgument('arguments', InputArgument::IS_ARRAY, 'Numeric arguments must be separated by spaces');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $section1 = $output->section();
        $section2 = $output->section();

        $io = new SymfonyStyle($input, $output);
        $arguments = $input->getArgument('arguments');

        if (!$arguments || count($arguments) > 10) {
            $io->error('Number of arguments should be more than 1 and less than 10');
            return 0;
        }

        $table = new Table($section2);
        $table->setHeaders(['Number', 'MaxValue'])->render();

        foreach ($arguments as $argument) {
            if (!is_numeric($argument) || $argument < 1 || $argument > 99999) {
                $io->error('Argument ' . $argument . ' is incorrect');
                return 0;
            }

            $maxValue = $this->algorithmService->getMaxValue($argument);
            $table->appendRow([$argument, $maxValue]);
        }

        $section1->clear();
        $io->success('Success!');

        return 0;
    }
}
