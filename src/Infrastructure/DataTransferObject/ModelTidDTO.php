<?php

/**
 * Class ModelTidDTO
 * @package App\Infrastructure\DataTransferObject
 */


namespace App\Infrastructure\DataTransferObject;


class ModelTidDTO
{
    private $id;

    private $modelTidId;

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

    public function getModelTidId()
    {
        return $this->modelTidId;
    }

    public function setModelTidId($modelTidId): void
    {
        $this->modelTidId = (int) $modelTidId;
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
