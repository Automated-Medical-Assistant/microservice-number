<?php


declare(strict_types=1);

namespace App\MessageHandler;

use App\Redis\RedisServiceInterface;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use App\Communication\CommunicationFacadeInterface;

class NumberCreationRequestMessageHandler
{
    private RedisServiceInterface $redisService;

    private CommunicationFacadeInterface $communicationFacade;

    /**
     * @param \App\Redis\RedisServiceInterface $redisService
     * @param \NumberService\Communication\CommunicationFacadeInterface $communicationFacade
     */
    public function __construct(RedisServiceInterface $redisService, CommunicationFacadeInterface $communicationFacade)
    {
        $this->redisService = $redisService;
        $this->communicationFacade = $communicationFacade;
    }
    public function __invoke(NumberCreationRequestAPIDataProvider $message)
    {
        try {
            $this->redisService->set((string)$message->getNumber(), json_encode($message->toArray()));
        } catch (\Throwable $e) {
            dump($e);
        }
        $this->communicationFacade->receiveNumberCreationRequest($message);
    }
}
