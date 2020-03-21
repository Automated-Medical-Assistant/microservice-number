<?php

declare(strict_types=1);

namespace App\Business;


use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;

interface BusinessFacadeInterface
{
    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider);

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider);
}
