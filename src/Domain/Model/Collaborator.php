<?php

namespace App\Domain\Model;

class Collaborator
{
    private int $id;

    private string $name;

    private ?int $collaboratorId;

    private ?int $systemUserId;

    private ?string $barCodeString;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCollaboratorId(): ?int
    {
        return $this->collaboratorId;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setCollaboratorId(?int $collaboratorId): void
    {
        $this->collaboratorId = $collaboratorId;
    }

    public function getSystemUserId(): ?int
    {
        return $this->systemUserId;
    }

    public function setSystemUserId(?int $systemUserId): void
    {
        $this->systemUserId = $systemUserId;
    }

    public function getBarCodeString(): ?string
    {
        return $this->barCodeString;
    }

    public function setBarCodeString(?string $barCodeString): void
    {
        $this->barCodeString = $barCodeString;
    }
}
