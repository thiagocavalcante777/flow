<?php

/**
 * Class ModelTidProcessBarCodeService
 * @package App\Infrastructure\Service
 */


namespace App\Infrastructure\Service;


use App\Domain\Model\ModelTask;
use App\Domain\Persistence\EntityRepository\ModelTidRepositoryInterface;
use App\Domain\Service\ModelTidProcessBarCodeServiceInterface;

class ModelTidProcessBarCodeService implements ModelTidProcessBarCodeServiceInterface
{
    private ModelTidRepositoryInterface $modelTidRepository;

    public function __construct(ModelTidRepositoryInterface $modelTidRepository)
    {
        $this->modelTidRepository = $modelTidRepository;
    }

    public function findById(int $id): ModelTask
    {
        $modelTid = $this->modelTidRepository->findByModelId($id);

        return $modelTid;
    }
}
