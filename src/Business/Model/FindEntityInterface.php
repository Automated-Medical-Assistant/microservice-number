<?php

declare(strict_types=1);

namespace App\Business\Model;


use App\Entity\Numbers;

interface FindEntityInterface
{
    public function getByNumber(string $number): Numbers;
}
