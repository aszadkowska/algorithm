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

        if ($arguments && count($arguments) <= 10) {
            $table = new Table($section2);
            $table->setHeaders(['Number', 'MaxValue'])->render();
            foreach ($arguments as $argument) {
                if (is_numeric($argument) && $argument >= 1 && $argument <= 99999) {
                    $maxValue = $this->algorithmService->getMaxValueInNumberString($argument);
                    $table->appendRow([$argument, $maxValue]);
                } else {
                    $io->error('Some arguments are incorrect');
                    return 0;
                }
            }
        } else {
            $io->error('You did not enter arguments or enter more than 10 numbers :(');
            return 0;
        }

        $section1->clear();
        $io->success('Success!');

        return 0;
    }
}
