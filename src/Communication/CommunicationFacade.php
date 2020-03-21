<?php

declare(strict_types=1);

namespace App\Communication;


use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use App\Business\BusinessFacadeInterface;
use MessageInfo\NumberListAPIDataProvider;

class CommunicationFacade implements CommunicationFacadeInterface
{
    /**
     * @var \App\Business\BusinessFacadeInterface
     */
    private BusinessFacadeInterface $businessFacade;

    public function __construct(BusinessFacadeInterface $businessFacade)
    {
        $this->businessFacade = $businessFacade;
    }

    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider): void
    {
        $this->businessFacade->receiveNumberChangeStateRequest($dataProvider);
    }

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider): void
    {
        $this->businessFacade->receiveNumberCreationRequest($dataProvider);
    }

    public function sendNumberListRequest(): NumberListAPIDataProvider
    {
        return $this->businessFacade->sendNumberListRequest();
    }
}
