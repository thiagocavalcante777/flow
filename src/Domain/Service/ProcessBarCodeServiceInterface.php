<?php


namespace App\Domain\Service;


use App\Infrastructure\DataTransferObject\TimeTaskDTO;

interface ProcessBarCodeServiceInterface
{
    public function processBarCode(string $barCodeString, TimeTaskDTO $timeTaskObject) : TimeTaskDTO;
}
