<?php

declare(strict_types=1);

namespace App\Business\Model;


use MessageInfo\NumberListAPIDataProvider;

interface FindEntityInterface
{
    public function getByNumber(string $number);

    public function getAll(): NumberListAPIDataProvider;
}
