<?php

declare(strict_types=1);

namespace App\Business\Model;


use App\Entity\Numbers;
use App\Repository\NumbersRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use MessageInfo\NumberChangeStateRequestAPIDataProvider;
use MessageInfo\NumberCreationRequestAPIDataProvider;

class Persist implements PersistInterface
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function persistCreation(NumberCreationRequestAPIDataProvider $dataProvider): void
    {
        $number = new Numbers();
        $number->setNumber($dataProvider->getNumber());
        $number->setDoctorId($dataProvider->getDoctorId());
        $number->setCreationDate(new DateTime($dataProvider->getCreationDate()));

        $this->save($number);
    }

    public function persistChange(NumberChangeStateRequestAPIDataProvider $dataProvider, Numbers $number): void
    {
        $number->setNumber($dataProvider->getNumber());
        $number->setStatus($dataProvider->getStatus());
        $number->setModifiedStateDate(new DateTime($dataProvider->getModifiedStateDate()));

        $this->save($number);
    }

    private function save(Numbers $numbers): void
    {
        $this->em->persist($numbers);
        $this->em->flush();
    }
}
