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
        $user->setFacebookToken('EAAYf6PHdgocBAIBdKzH0OJN9ht9weCGc
        W2VNXKVJJqSPAuweUpwv1g2eCCxcke4ciXtg5KJOeQZAxHtWVFv9vkNKrU
        9nOLRWtSJ2FfnFCisF0EAXkS2oXbyaQdg8Rv331DMgyPoGClLiUMpxFkL9
        34bRPjM0085J7ZB7wlLwZDZD');
        $this->em->persist($user);
        $this->em->flush();
        $output->writeln('Admin user has been created.');
    }
}
