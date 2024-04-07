<?php

namespace App\Domain\Persistence\EntityRepository;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Expr\OrderBy;

/**
 * Interface AuxiliarSearchableRepositoryInterface
 * @package App\Domain\Persistence\EntityRepository
 */
interface AuxiliarSearchableRepositoryInterface
{
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
    ): array;
}
