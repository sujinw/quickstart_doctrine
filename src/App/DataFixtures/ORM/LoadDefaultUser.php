<?php

namespace App\DataFixtures\ORM;

use App\Model\Entity\User;
use \Doctrine\Common\DataFixtures\AbstractFixture;
use \Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;

class LoadDefaultUser extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("Leonardo Farias Galvão");
        $user->setEmail("leoo.farias@gmail.com");
        $user->setPassword(md5(123456));

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}