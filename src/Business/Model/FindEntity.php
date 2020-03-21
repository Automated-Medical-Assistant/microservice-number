<?php

declare(strict_types=1);

namespace App\Business\Model;


use App\Redis\RedisServiceInterface;
use MessageInfo\NumberAPIDataProvider;
use MessageInfo\NumberListAPIDataProvider;

class FindEntity implements FindEntityInterface
{
    /**
     * @var \App\Business\Model\RedisServiceInterface
     */
    private RedisServiceInterface $redisService;

    public function __construct(RedisServiceInterface $redisService)
    {
        $this->redisService = $redisService;
    }

    public function getByNumber(string $number): NumberAPIDataProvider
    {
        $data = json_decode($this->redisService->get($number), true, 512, JSON_THROW_ON_ERROR);
        $transfer = new NumberAPIDataProvider();
        $transfer->fromArray($data);

        return $transfer;
    }

    public function getAll(): NumberListAPIDataProvider
    {
        $list = new NumberListAPIDataProvider();
        $redisList = $this->redisService->getAll();

        foreach($redisList as $numberArray) {
            $transfer = new NumberAPIDataProvider();
            $transfer->fromArray(json_decode($numberArray, true));
            $list->addNumber($transfer);
        }

        return $list;
    }
}
