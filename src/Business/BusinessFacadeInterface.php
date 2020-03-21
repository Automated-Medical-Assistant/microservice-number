<?php

declare(strict_types=1);

namespace App\Business;


use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use MessageInfo\NumberListAPIDataProvider;

interface BusinessFacadeInterface
{
    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider): void;

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider): void;

    public function sendNumberListRequest(): NumberListAPIDataProvider;
}
