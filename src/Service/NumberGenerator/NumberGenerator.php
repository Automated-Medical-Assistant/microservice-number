<?php

declare(strict_types=1);

namespace App\Service\NumberGenerator;


class NumberGenerator implements NumberGeneratorInterface
{

    public function generate(): string
    {
        return
            $this->getStateIso().
            $this->getDatTimeString();
    }

    private function getDatTimeString(): string
    {
        return (string)time();
    }

    public function getStateIso(): string
    {
        return 'NRW';
    }
}
