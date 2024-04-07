<?php


namespace App\Domain\Persistence\EntityRepository;


use App\Domain\Model\Collaborator;

interface CollaboratorRepositoryInterface extends AuxiliarSearchableRepositoryInterface
{
    public function findByCollaboratorId(int $collaboratorId) : Collaborator;

    public function findBySystemUserId(int $systemUserId) : Collaborator;

    public function findByBarCodeString(string $barCodeString) : Collaborator;
}
