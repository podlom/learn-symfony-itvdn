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
         // @see: php bin/console security:hash-password
         // Hasher used     Symfony\Component\PasswordHasher\Hasher\MigratingPasswordHasher
         // ! [NOTE] Self-salting hasher used: the hasher generated its own built-in salt.
         $user->setPassword('$2y$13$ZMdsnksL4KVvkYLJsgXeX.GbR94S30o/TT4sxO3HlOPGI0nehVhnW'); // TestPass-123
         $user->setRoles(['ROLE_USER']);

         $manager->persist($user);
         $manager->flush();
    }
}
