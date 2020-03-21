<?php

declare(strict_types=1);

namespace App\Business;


use App\Business\Model\FindEntityInterface;
use App\Business\Model\PersistInterface;
use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;
use App\Service\NumberGenerator\NumberGeneratorInterface;

class BusinessFacade implements BusinessFacadeInterface
{
    /**
     * @var \NumberService\Service\NumberGenerator\NumberGeneratorInterface
     */
    private NumberGeneratorInterface $numberGenerator;

    /**
     * @var \App\Business\Model\PersistInterface
     */
    private PersistInterface $persist;

    /**
     * @var \App\Business\Model\FindEntityInterface
     */
    private FindEntityInterface $findEntity;

    public function __construct(NumberGeneratorInterface $numberGenerator, PersistInterface $persist, FindEntityInterface $findEntity)
    {
        $this->numberGenerator = $numberGenerator;
        $this->persist = $persist;
        $this->findEntity = $findEntity;
    }

    public function receiveNumberChangeStateRequest(NumberChangeStateRequestAPIDataProvider $dataProvider): void
    {
        $number = $this->findEntity->getByNumber($dataProvider->getNumber());
        $this->persist->persistChange($dataProvider, $number);
    }

    public function receiveNumberCreationRequest(NumberCreationRequestAPIDataProvider $dataProvider): void
    {
        $dataProvider->setNumber($this->numberGenerator->generate());
        $this->persist->persistCreation($dataProvider);
    }
}
