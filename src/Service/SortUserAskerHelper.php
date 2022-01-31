<?php

namespace App\Service;

use App\Entity\User;

class SortUserAskerHelper
{
    /**
     * Service that helps sorting who is who in a swap, and also reduces the cyclomatic complexity of a controller
     *
     * It receives an array of the current user and the two users of a swap
     * It returns an array containing the current user and the other user involved in the swap
     * If the current user isn't involved in the current swap, or if the class check fails, it returns false instead
     */
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
