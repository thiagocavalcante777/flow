<?php

/**
 * Class CollaboratorDTO
 * @package App\Infrastructure\DataTransferObject
 */

namespace App\Infrastructure\DataTransferObject;

class CollaboratorDTO
{
    private $id;

    private $name;

    private $collaboratorId;

    private $systemUserId;

    private $barCodeString;

    public function setId($id) : void
    {
        $this->id = (int) $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCollaboratorId()
    {
        return $this->collaboratorId;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setCollaboratorId($collaboratorId): void
    {
        $this->collaboratorId = (int) $collaboratorId;
    }

    public function getSystemUserId()
    {
        return $this->systemUserId;
    }

    public function setSystemUserId($systemUserId): void
    {
        $this->systemUserId = (int) $systemUserId;
    }


}
