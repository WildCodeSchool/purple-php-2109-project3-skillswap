<?php

namespace App\Service;

use App\Entity\User;

class SortUserAskerHelper
{
    /**
     * Service that verifies the class of user variables
     *
     * It receives an array of any number of user and checks the user class
     * It returns a bool, true if the check succeed, false if it fails
     */
    public function verify(array $users): bool
    {
        foreach ($users as $user) {
            if (!($user instanceof User)) {
                return false;
            }
        }
        return true;
    }

    public function sort(array $array): array
    {
        $user = $array["user"];
        $asker = $array["asker"];
        $helper = $array["helper"];
        if ($this->verify([$user, $asker, $helper])) {
            if ($user->getId() === $asker->getId()) {
                return [
                "mainUser" => $asker,
                "secondUser" => $helper,
                ];
            } elseif ($user->getId() === $helper->getId()) {
                return [
                "mainUser" => $helper,
                "secondUser" => $asker,
                ];
            }
        }
        return [false];
    }
}
