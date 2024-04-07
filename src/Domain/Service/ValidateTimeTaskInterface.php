<?php


namespace App\Domain\Service;


use App\Infrastructure\DataTransferObject\TimeTaskDTO;

interface ValidateTimeTaskInterface
{
    public function validateStartTimeTask(TimeTaskDTO $timeTaskDTO): bool;
}