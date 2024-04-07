<?php

namespace App\Domain\Model;

class ModelTask
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int|null
     */
    private $modelTaskId;

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

    public function getModelTaskId(): ?int
    {
        return $this->modelTaskId;
    }

    public function setModelTaskId(?int $modelTaskId): void
    {
        $this->modelTaskId = $modelTaskId;
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
