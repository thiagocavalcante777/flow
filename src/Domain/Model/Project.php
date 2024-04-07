<?php

namespace App\Domain\Model;

class Project
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int|null
     */
    private $projectId;

    /**
     * @var string|null
     */
    private $reference;

    /**
     * @var string|null
     */
    private $designation;

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
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @param int|null $projectId
     */
    public function setProjectId(?int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     */
    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string|null
     */
    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    /**
     * @param string|null $designation
     */
    public function setDesignation(?string $designation): void
    {
        $this->designation = $designation;
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
