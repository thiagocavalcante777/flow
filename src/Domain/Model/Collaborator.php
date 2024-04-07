<?php

namespace App\Domain\Model;

class Collaborator
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int|null
     */
    private $collaboratorId;

    /**
     * @var int|null
     */
    private $systemUserId;

    /**
     * @var string|null
     */
    private $barCodeString;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getCollaboratorId(): ?int
    {
        return $this->collaboratorId;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int|null $collaboratorId
     */
    public function setCollaboratorId(?int $collaboratorId): void
    {
        $this->collaboratorId = $collaboratorId;
    }

    /**
     * @return int|null
     */
    public function getSystemUserId(): ?int
    {
        return $this->systemUserId;
    }

    /**
     * @param int|null $systemUserId
     */
    public function setSystemUserId(?int $systemUserId): void
    {
        $this->systemUserId = $systemUserId;
    }

    /**
     * @return string|null
     */
    public function getBarCodeString(): ?string
    {
        return $this->barCodeString;
    }

    /**
     * @param string|null $barCodeString
     */
    public function setBarCodeString(?string $barCodeString): void
    {
        $this->barCodeString = $barCodeString;
    }
}
