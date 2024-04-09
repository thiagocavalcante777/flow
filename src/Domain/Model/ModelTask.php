<?php

namespace App\Domain\Model;

class ModelTask
{
    private int $id;

    private ?int $modelTaskId;

    private ?string $designation;

    private ?string $barCodeString;

    public function getId(): int
    {
        return $this->id;
    }

    public function getModelTaskId(): ?int
    {
        return $this->modelTaskId;
    }

    public function setModelTaskId(?int $modelTaskId): void
    {
        $this->modelTaskId = $modelTaskId;
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
