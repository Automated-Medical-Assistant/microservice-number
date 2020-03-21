<?php

declare(strict_types=1);

namespace App\Business;


use App\Business\Model\FindEntityInterface;
use App\Business\Model\PersistInterface;
use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use MessageInfo\NumberListAPIDataProvider;

class BusinessFacade implements BusinessFacadeInterface
{
    /**
     * @var \App\Business\Model\PersistInterface
     */
    private PersistInterface $persist;

    /**
     * @var \App\Business\Model\FindEntityInterface
     */
    private FindEntityInterface $findEntity;

    public function __construct(PersistInterface $persist, FindEntityInterface $findEntity)
    {
        $this->persist = $persist;
        $this->findEntity = $findEntity;
    }

    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider): void
    {
        $numberAPIData = $this->findEntity->getByNumber($dataProvider->getNumber());
        $this->persist->persistChange($dataProvider, $numberAPIData);
    }

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider): void
    {
        $this->persist->persistCreation($dataProvider);
    }

    public function sendNumberList(): NumberListAPIDataProvider
    {
        return $this->findEntity->getAll();
    }

    public function sendNumberListRequest(): NumberListAPIDataProvider
    {
        return $this->findEntity->getAll();
    }
}
