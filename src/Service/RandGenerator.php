<?php

namespace App\Service;


class RandGenerator
{
    public function randomNumber(int $from, int $to): string
    {
        return rand($from, $to);
    }
}
