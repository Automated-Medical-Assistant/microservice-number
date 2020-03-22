<?php

declare(strict_types=1);

namespace App\Communication\Plugin;


use MessageInfo\NumberListAPIDataProvider;
use Symfony\Component\Messenger\MessageBusInterface;

class NumberListDispatcher implements NumberListDispatcherInterface
{
    /**
     * @var \Symfony\Component\Messenger\MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function dispatch(NumberListAPIDataProvider $dataProvider): void
    {
        $this->messageBus->dispatch($dataProvider);
    }
}
