<?php

declare(strict_types=1);

namespace App\Communication;


use App\Communication\Plugin\NumberListDispatcherInterface;
use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use App\Business\BusinessFacadeInterface;

class CommunicationFacade implements CommunicationFacadeInterface
{
    /**
     * @var \App\Business\BusinessFacadeInterface
     */
    private BusinessFacadeInterface $businessFacade;
    /**
     * @var \App\Communication\Plugin\NumberListDispatcherInterface
     */
    private NumberListDispatcherInterface $dispatcher;

    public function __construct(BusinessFacadeInterface $businessFacade, NumberListDispatcherInterface $dispatcher)
    {
        $this->businessFacade = $businessFacade;
        $this->dispatcher = $dispatcher;
    }

    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider): void
    {
        $this->businessFacade->receiveNumberChangeStateRequest($dataProvider);
    }

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider): void
    {
        $this->businessFacade->receiveNumberCreationRequest($dataProvider);
    }

    public function sendNumberListRequest(): void
    {
        $dataProvider = $this->businessFacade->sendNumberListRequest();
        $this->dispatcher->dispatch($dataProvider);
    }
}
