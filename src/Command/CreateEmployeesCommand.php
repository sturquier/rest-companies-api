<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use App\Entity\Employee;
use App\Entity\Result;

class CreateEmployeesCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'mock:create-employees';

    protected function configure()
    {
        $this->setDescription('Fill in database with mock/employees.json content');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $now = new \DateTime();

        $io->note('Start filling : ' . $now->format('d/m/Y H:i:s'));

        $this->createEmployees($input, $output);

        $io->success('End filling : ' . $now->format('d/m/Y H:i:s'));
    }

    private function createEmployees(InputInterface $input, OutputInterface $output)
    {
        $mockFile = file_get_contents(__DIR__ . '/../../mock/employees.json');

        $progress = new ProgressBar($output, 1000);
        $progress->start();

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        foreach (json_decode($mockFile) as $mock) {
            $employee = new Employee();
            
            $employee->setName($mock->name);
            $employee->setSector($mock->sector);
            $employee->setSiren($mock->siren);

            foreach ($mock->results as $r) {
                $result = new Result();

                $result->setCa($r->ca);
                $result->setMargin($r->margin);
                $result->setEbitda($r->ebitda);
                $result->setLoss($r->loss);
                $result->setYear($r->year);

                $em->persist($result);
                $employee->addResult($result);

            }

            $em->persist($employee);
            $em->flush();

            $progress->advance(1);
        }

        $em->flush();
        $progress->finish();
    }

}
