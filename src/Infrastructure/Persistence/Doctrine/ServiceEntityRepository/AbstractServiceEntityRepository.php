<?php

namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractServiceEntityRepository extends EntityRepository
{

    /**
     * AbstractServiceEntityRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param                        $entityClass
     */
    public function __construct(EntityManagerInterface $entityManager, $entityClass)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata($entityClass));
    }
}
