<?php

namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\QueryBuilder;

class AbstractKeyValueServiceEntityRepository extends AbstractServiceEntityRepository
{
    /**
     * @param string $keyField
     * @param string $valueField
     * @param OrderBy|null $orderBy
     * @param Criteria|null $criteria
     * @return array
     * @throws QueryException
     */
    public function resultArray(
        string $keyField,
        string $valueField,
        OrderBy $orderBy = null,
        Criteria $criteria = null
    ): array {
        $queryBuilder = $this->buildQuery($keyField, $valueField);
        $this->buildCriteria($queryBuilder, $criteria);
        $this->buildOrderBy($queryBuilder, $orderBy);
        $query = $queryBuilder->getQuery();
        $query->enableResultCache(3600);

        return $query->getArrayResult();
    }

    /**
     * @param string $keyField
     * @param string $valueField
     * @return QueryBuilder
     */
    protected function buildQuery(string $keyField, string $valueField): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select(["a.{$keyField} as key", "a.{$valueField} as value"]);

        return $queryBuilder;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param Criteria|null $criteria
     * @throws QueryException
     */
    protected function buildCriteria(QueryBuilder $queryBuilder, Criteria $criteria = null)
    {
        if ($criteria) {
            $queryBuilder->addCriteria($criteria);
        }
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param OrderBy|null $orderBy
     */
    protected function buildOrderBy(QueryBuilder $queryBuilder, OrderBy $orderBy = null)
    {
        if ($orderBy) {
            $queryBuilder->addOrderBy($orderBy);
        }
    }
}
