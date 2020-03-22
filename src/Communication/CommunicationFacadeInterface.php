<?php

declare(strict_types=1);

namespace App\Communication;


use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;

interface CommunicationFacadeInterface
{
    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider): void;

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider): void;

    public function sendNumberListRequest(): void;
}
