<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UsersFixtures extends Fixture
{
    public const USERS = [
        ['Olivier', 'oli.g@gmail.com', '1234'],
        ['Cécile', 'cec.do@gmail.com', '1234'],
        ['Benjamin', 'benj.b@gmail.com', '1234'],
        ['Bruno', 'bru.f@gmail.com', '1234'],
        ['Sébastien', 'seb.v@gmail.com', '1234'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $user) {
            $users = new Users();
            $users->setFirstname($user[0]);
            $users->setEmail($user[1]);
            $users->setPassword($user[2]);
            $manager->persist($users);
            /*$this->addReference('user_' . $key, $users);*/
        }
        $manager->flush();
    }
}
