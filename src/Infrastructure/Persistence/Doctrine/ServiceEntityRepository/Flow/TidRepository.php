<?php

/**
 * Class TidRepository
 * @package App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\PromaintFactory
 */


namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\Flow;

use App\Domain\Model\ModelTask;
use App\Domain\Model\Project;
use App\Domain\Model\Tid;
use App\Domain\Persistence\EntityRepository\TidRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\AbstractServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class TidRepository extends AbstractServiceEntityRepository implements TidRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Tid::class);
    }

    public function findByTidId(int $tidId): Tid
    {
        // TODO: Implement findByTidId() method.
    }

    public function findByModelTid(ModelTask $modelTid): ?array
    {
        // TODO: Implement findByModelTid() method.
    }

    public function findByProject(Project $project): ?array
    {
        // TODO: Implement findByProject() method.
    }
}
