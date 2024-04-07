<?php

/**
 * Class ModelTidRepository
 * @package App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\PromaintFactory
 */


namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\Flow;


use App\Domain\Model\ModelTask;
use App\Domain\Persistence\EntityRepository\ModelTidRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\AbstractServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ModelTidRepository extends AbstractServiceEntityRepository implements ModelTidRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, ModelTask::class);
    }

    public function findByModelId(int $modelTid): ModelTask
    {
        return $this->findOneBy(['modelTidId' => $modelTid]);
    }

    public function findByBarCodeString(string $barCodeString): ModelTask
    {
        // TODO: Implement findByBarCodeString() method.
    }

    public function findAll() : array
    {
        return $this->findAll();
    }
}
