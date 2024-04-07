<?php

/**
 * Class ProjectDTO
 * @package App\Infrastructure\DataTransferObject
 */


namespace App\Infrastructure\DataTransferObject;


class ProjectDTO
{

    private $id;

    private $projectId;

    private $reference;

    private $designation;

    private $barCodeString;

    public function setId($id) : void
    {
        $this->id = (int) $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function setProjectId($projectId): void
    {
        $this->projectId = (int) $projectId;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference): void
    {
        $this->reference = $reference;
    }

    public function getDesignation()
    {
        return $this->designation;
    }

    public function setDesignation($designation): void
    {
        $this->designation = $designation;
    }

    public function getBarCodeString()
    {
        return $this->barCodeString;
    }

    public function setBarCodeString($barCodeString): void
    {
        $this->barCodeString = $barCodeString;
    }
}
