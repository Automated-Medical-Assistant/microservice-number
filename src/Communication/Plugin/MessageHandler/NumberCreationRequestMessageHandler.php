<?php


declare(strict_types=1);

namespace App\Communication\Plugin\MessageHandler;

use MessageInfo\NumberCreationRequestAPIDataProvider;
use App\Communication\CommunicationFacadeInterface;

class NumberCreationRequestMessageHandler
{
    private CommunicationFacadeInterface $communicationFacade;

    /**
     * @param \App\Communication\CommunicationFacadeInterface $communicationFacade
     */
    public function __construct(CommunicationFacadeInterface $communicationFacade)
    {
        $this->communicationFacade = $communicationFacade;
    }
    public function __invoke(NumberCreationRequestAPIDataProvider $message): void
    {
        $this->communicationFacade->receiveNumberCreationRequest($message);
    }
}
