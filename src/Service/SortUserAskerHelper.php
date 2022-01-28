<?php

namespace App\Service;

use App\Entity\User;

class SortUserAskerHelper
{
    public function sort(array $array): array
    {
        $user = $array["user"];
        $asker = $array["asker"];
        $helper = $array["helper"];
        if (
            ($user instanceof User) &&
            ($asker instanceof User) &&
            ($helper instanceof User)
        ) {
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
