<?php


namespace App\Domain\Service;


use App\Domain\Model\Project;

interface ProjectProcessBarCodeServiceInterface
{
    public function findById(int $id) : Project;
}
