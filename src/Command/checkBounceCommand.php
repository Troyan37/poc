<?php

namespace App\Command;

use App\Entity\Entity\Mailing;
use App\Service\calculateBounceService;
use App\Service\configService;
use App\Service\sesClientService;
use Exception;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class checkBounceCommand extends ContainerAwareCommand
{

    protected static $defaultName = 'app:check-bounce';

    //sprawdz czy procent bounców jest wiekszy niż 2%, jeśli tak to zakoncz wysyłanie obecnego mailingu i zmien status na E
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $client = sesClientService::getSESClient();
        try {
            /*echo calculateBounceService::getBounce(
                    $client->getSendStatistics([])
                ) . PHP_EOL;*/

            if(calculateBounceService::getBounce($client->getSendStatistics([])) > 2){

                $entityManager = $this->getContainer()->get('doctrine')->getManager();
                $mailingRepository = $this->getContainer()->get('doctrine')->getRepository(Mailing::class);

                $mailing = $mailingRepository->findOneBy(array('status' => 'S'));
                $mailing->setStatus('E'); //zmien status na E - Error, przestań wysyłać ten mailing

                $entityManager->persist($mailing);
                $entityManager->flush();

            }

        } catch (Exception $e) {
            echo($e->getMessage() . PHP_EOL);
        }
    }
}
