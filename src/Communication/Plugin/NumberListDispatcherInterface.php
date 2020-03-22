<?php

declare(strict_types=1);

namespace App\Communication\Plugin;


use MessageInfo\NumberListAPIDataProvider;

interface NumberListDispatcherInterface
{
    public function dispatch(NumberListAPIDataProvider $dataProvider): void;
}
