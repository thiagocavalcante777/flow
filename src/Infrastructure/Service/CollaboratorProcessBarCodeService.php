<?php

/**
 * Class CollaboratorProcessBarCodeService
 * @package App\Infrastructure\Service
 */
namespace App\Infrastructure\Service;

use App\Domain\Persistence\EntityRepository\CollaboratorRepositoryInterface;
use App\Domain\Model\Collaborator;
use App\Domain\Service\CollaboratorProcessBarCodeServiceInterface;

class CollaboratorProcessBarCodeService implements CollaboratorProcessBarCodeServiceInterface
{
    private CollaboratorRepositoryInterface $collaboratorRepository;

    public function __construct(CollaboratorRepositoryInterface $collaboratorRepository)
    {
        $this->collaboratorRepository = $collaboratorRepository;
    }

    public function findById(int $id): Collaborator
    {
       $collaborator = $this->collaboratorRepository->findByCollaboratorId($id);

       return $collaborator;
    }
}
