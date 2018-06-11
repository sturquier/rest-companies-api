<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use App\Entity\Company;
use App\Entity\Result;

class CreateCompaniesCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'mock:create-companies';

    protected function configure()
    {
        $this->setDescription('Fill in database with mock/companies.json content');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $now = new \DateTime();

        $io->note('Start filling : ' . $now->format('d/m/Y H:i:s'));

        $this->createCompanies($input, $output);

        $io->success('End filling : ' . $now->format('d/m/Y H:i:s'));
    }

    private function createCompanies(InputInterface $input, OutputInterface $output)
    {
        $mockFile = file_get_contents(__DIR__ . '/../../mock/companies.json');

        $progress = new ProgressBar($output, 1000);
        $progress->start();

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        foreach (json_decode($mockFile) as $mock) {
            $company = new Company();
            
            $company->setName($mock->name);
            $company->setSector($mock->sector);
            $company->setSiren($mock->siren);

            foreach ($mock->results as $r) {
                $result = new Result();

                $result->setCa($r->ca);
                $result->setMargin($r->margin);
                $result->setEbitda($r->ebitda);
                $result->setLoss($r->loss);
                $result->setYear($r->year);

                $em->persist($result);
                $company->addResult($result);

            }

            $em->persist($company);
            $em->flush();

            $progress->advance(1);
        }

        $em->flush();
        $progress->finish();
    }

}
