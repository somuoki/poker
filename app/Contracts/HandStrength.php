<?php

namespace App\Contracts;

interface HandStrength
{
    public function checkHand();

    public function sortBySuit();

    public function sortByRank();

}
