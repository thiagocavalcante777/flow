<?php

/**
 * Class BarCodeTypeEnum
 * @package App\Domain\Enum
 */


namespace App\Domain\Enum;


abstract class BarCodeTypeEnum
{
    const PROJECT = 'project';
    const MODEL_TID = 'model_task';
    const COLLABORATOR = "collaborator";
    const REQUISITION_MATERIAL = 'requisition_material';
}
