<?php


namespace App\Domain\Service;


use App\Domain\Model\ModelTask;

interface ModelTidProcessBarCodeServiceInterface
{
    public function findById(int $id) : ModelTask;
}
