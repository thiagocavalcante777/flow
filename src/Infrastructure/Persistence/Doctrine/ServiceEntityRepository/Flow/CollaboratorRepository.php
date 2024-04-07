<?php

/**
 * Class CollaboratorRepository
 * @package App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\PromaintFactory
 */


namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\Flow;


use App\Domain\Model\Collaborator;
use App\Domain\Persistence\EntityRepository\CollaboratorRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\AbstractServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\OrderBy;

class CollaboratorRepository extends AbstractServiceEntityRepository implements CollaboratorRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Collaborator::class);
    }

    /**
     * @param string $keyField
     * @param string $valueField
     * @param OrderBy|null $orderBy
     * @param Criteria|null $criteria
     * @return array
     */
    public function resultArray(
        string $keyField,
        string $valueField,
        OrderBy $orderBy = null,
        Criteria $criteria = null
    ): array {
        // TODO: Implement resultArray() method.
    }

    public function findByCollaboratorId(int $collaboratorId): Collaborator
    {
        return $this->findOneBy(['systemUserId' => $collaboratorId]);
    }

    public function findBySystemUserId(int $systemUserId): Collaborator
    {
        // TODO: Implement findBySystemUserId() method.
    }

    public function findByBarCodeString(string $barCodeString): Collaborator
    {
        // TODO: Implement findByBarCodeString() method.
    }
}
