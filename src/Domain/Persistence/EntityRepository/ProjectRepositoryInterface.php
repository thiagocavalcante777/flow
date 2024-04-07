<?php


namespace App\Domain\Persistence\EntityRepository;


use App\Domain\Model\Project;

interface ProjectRepositoryInterface
{
    public function findByProjectId(int $projectId) : Project;

    public function findByReference(string $reference) : Project;

    public function findByBarCodeString(string $barCodeString) : Project;
}
