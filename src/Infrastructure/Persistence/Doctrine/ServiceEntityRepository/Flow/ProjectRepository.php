<?php

/**
 * Class ProjectRepository
 * @package App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\PromaintFactory
 */


namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\Flow;


use App\Domain\Model\Project;
use App\Domain\Persistence\EntityRepository\ProjectRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\AbstractServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProjectRepository extends AbstractServiceEntityRepository implements ProjectRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Project::class);
    }

    public function findByProjectId(int $projectId): Project
    {
        return $this->findOneBy(['projectId' => $projectId]);
    }

    public function findByReference(string $reference): Project
    {
        // TODO: Implement findByReference() method.
    }

    public function findByBarCodeString(string $barCodeString): Project
    {
        // TODO: Implement findByBarCodeString() method.
    }
}
