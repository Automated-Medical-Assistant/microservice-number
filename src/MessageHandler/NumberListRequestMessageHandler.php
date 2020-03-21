<?php


declare(strict_types=1);

namespace App\MessageHandler;

use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use App\Communication\CommunicationFacadeInterface;

class NumberListRequestMessageHandler
{
    private CommunicationFacadeInterface $communicationFacade;

    /**
     * @param \App\Communication\CommunicationFacadeInterface $communicationFacade
     */
    public function __construct(CommunicationFacadeInterface $communicationFacade)
    {
        $this->communicationFacade = $communicationFacade;
    }

    /**
     * @param \MessageInfo\NumberChangeStateRequestAPIDataProvider $message
     */
    public function __invoke(NumberChangeStateRequestAPIDataProvider $message): void
    {
        $this->communicationFacade->receiveNumberChangeStateRequest($message);
    }
}
