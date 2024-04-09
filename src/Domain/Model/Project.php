<?php

namespace App\Domain\Model;

class Project
{
    private int $id;

    private int $projectId;

    private ?string $reference;

    private ?string $designation;

    private ?string $barCodeString;

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function setProjectId(?int $projectId): void
    {
        $this->projectId = $projectId;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): void
    {
        $this->designation = $designation;
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
