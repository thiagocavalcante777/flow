<?php

/**
 * Class ProjectProcessBarCodeService
 * @package App\Infrastructure\Service
 */


namespace App\Infrastructure\Service;


use App\Domain\Model\Project;
use App\Domain\Persistence\EntityRepository\ProjectRepositoryInterface;
use App\Domain\Service\ProjectProcessBarCodeServiceInterface;

class ProjectProcessBarCodeService implements ProjectProcessBarCodeServiceInterface
{
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function findById(int $id) : Project
    {
        $project = $this->projectRepository->findByProjectId($id);

        return $project;
    }
}
