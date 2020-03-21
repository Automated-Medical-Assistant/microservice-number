<?php

declare(strict_types=1);

namespace App\Communication;


use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;

interface CommunicationFacadeInterface
{
    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider);

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider);
}
