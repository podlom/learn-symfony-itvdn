<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setEmail('podlom@gmail.com');
         $user->setPassword('TestPass-123');
         $user->setRoles('ROLE_USER');

         $manager->persist($user);
         $manager->flush();
    }
}
