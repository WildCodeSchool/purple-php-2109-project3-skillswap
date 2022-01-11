<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UsersFixtures extends Fixture
{
    public const USERS = [
        ['Olivier', 'oli.g@gmail.com', '$2y$13$nz8WHMPl5ft66EbWhPWPyuau4g2YbMXxQtsje2S.ktslaJn/gAYCq'],
        ['Cécile', 'cec.do@gmail.com', '$2y$13$nz8WHMPl5ft66EbWhPWPyuau4g2YbMXxQtsje2S.ktslaJn/gAYCq'],
        ['Benjamin', 'benj.b@gmail.com', '$2y$13$nz8WHMPl5ft66EbWhPWPyuau4g2YbMXxQtsje2S.ktslaJn/gAYCq'],
        ['Bruno', 'bru.f@gmail.com', '$2y$13$nz8WHMPl5ft66EbWhPWPyuau4g2YbMXxQtsje2S.ktslaJn/gAYCq'],
        ['Sébastien', 'seb.v@gmail.com', '$2y$13$nz8WHMPl5ft66EbWhPWPyuau4g2YbMXxQtsje2S.ktslaJn/gAYCq'],
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
