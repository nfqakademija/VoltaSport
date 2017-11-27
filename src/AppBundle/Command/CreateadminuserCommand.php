<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateadminuserCommand extends Command
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setName('app:createadminuser')
            ->setDescription('Create a user with Admin role')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $user = new User();

        $user->setEmail('evaldas.puz@gmail.com');
        $user->setName('Evaldas Pužauskas');
        $user->setUsername('Evaldas Pužauskas');
        $user->setFacebookId('2414599508765297');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFacebookToken('EAACTaEISehUBAA3ZC03HKlZBiJRZAZAiIoB6aiENvSLUFwnujhsV6e6Xd8YthNSZBA67t0H5SCbdKMZAuUPVhWynbEyTda8ZCMDgVrew0AoYlbs4nmvmI2c91ZAJZCVZB23RrZBnk6AaIZBYZBz5YQPDDEdRsQHvfgS4RtyoZD');
        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('Admin user has been created.');
    }

}
