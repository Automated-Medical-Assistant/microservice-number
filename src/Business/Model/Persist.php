<?php

declare(strict_types=1);

namespace App\Business\Model;


use App\Redis\RedisServiceInterface;
use MessageInfo\NumberAPIDataProvider;
use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use Xervice\DataProvider\Business\Model\DataProvider\DataProviderInterface;

class Persist implements PersistInterface
{
    /**
     * @var \App\Business\Model\RedisServiceInterface
     */
    private RedisServiceInterface $redisService;

    public function __construct(RedisServiceInterface $redisService)
    {
        $this->redisService = $redisService;
    }

    public function persistCreation(NumberCreationRequestAPIDataProvider $dataProvider): void
    {
        $redisTransfer = new NumberAPIDataProvider();
        $redisTransfer->setNumber($dataProvider->getNumber());
        $redisTransfer->setDoctorId($dataProvider->getDoctorId());
        $redisTransfer->setCreationDate($dataProvider->getCreationDate());

        $this->redisService->set($dataProvider->getNumber(), json_encode($redisTransfer->toArray(), JSON_THROW_ON_ERROR, 512));
    }

    public function persistChange(NumberChangeStateRequestAPIDataProvider $dataProvider, NumberAPIDataProvider $numberAPIData): void
    {
        $numberAPIData->setNumber($dataProvider->getNumber());
        $numberAPIData->setModifiedStateDate($dataProvider->getModifiedStateDate());
        $numberAPIData->setStatus($dataProvider->getStatus());

        $this->redisService->set($dataProvider->getNumber(), json_encode($numberAPIData->toArray(), JSON_THROW_ON_ERROR, 512));
    }
}
