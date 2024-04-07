<?php


namespace App\Domain\Persistence\EntityRepository;


use App\Domain\Model\ModelTask;
use App\Domain\Model\Project;
use App\Domain\Model\Tid;

interface TidRepositoryInterface
{
    public function findByTidId(int $tidId) : Tid;

    public function findByModelTid(ModelTask $modelTid) : ?array;

    public function findByProject(Project $project) : ?array;
}
