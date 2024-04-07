<?php


namespace App\Domain\Persistence\EntityRepository;


use App\Domain\Model\ModelTask;

interface ModelTidRepositoryInterface
{
    public function findByModelId(int $modelTid) : ModelTask;

    public function findByBarCodeString(string $barCodeString) : ModelTask;

    public function findAll() : array;
}
