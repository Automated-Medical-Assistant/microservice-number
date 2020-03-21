<?php

declare(strict_types=1);

namespace App\Business\Model;


use App\Entity\Numbers;
use App\Repository\NumbersRepository;

class FindEntity implements FindEntityInterface
{
    /**
     * @var \App\Repository\NumbersRepository
     */
    private NumbersRepository $repository;

    public function __construct(NumbersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByNumber(string $number): Numbers
    {
        return $this->repository->findOneByNumber($number);
    }
}
