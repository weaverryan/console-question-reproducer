<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class TestingCommand extends Command
{
    protected static $defaultName = 'app:test';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = new QuestionHelper();
        $question = new Question('Enter number (min 10): ');
        $question->setValidator(function($val) {
            if ($val < 10) {
                throw new \Exception('Choose something higher');
            }

            return $val;
        });

        $number = $questionHelper->ask($input, $output, $question);
        $output->writeln($number);

        return 0;
    }
}
