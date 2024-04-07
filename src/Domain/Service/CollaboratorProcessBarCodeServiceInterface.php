<?php


namespace App\Domain\Service;


use App\Domain\Model\Collaborator;

interface CollaboratorProcessBarCodeServiceInterface
{
    public function findById(int $id) : Collaborator;
}
