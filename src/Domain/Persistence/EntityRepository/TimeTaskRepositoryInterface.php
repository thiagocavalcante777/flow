<?php


namespace App\Domain\Persistence\EntityRepository;


use App\Domain\Model\Collaborator;
use App\Domain\Model\TimeTask;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;

interface TimeTaskRepositoryInterface extends AuxiliarSearchableRepositoryInterface
{
    public function saveStartTimeTask(TimeTaskDTO $timeTask) : bool;

    public function saveFinishingTimeTask(TimeTaskDTO $timeTask) : bool;

    public function timesTasksToRectify() : ?array;

    public function timesTasksToMonitor() : ?array;

    public function findOpened(Collaborator $collaborator) : ?TimeTask;

    public function findOpenedById(int $timeTaskId) : ?TimeTask;

    public function  findLastClosed(Collaborator $collaborator) : TimeTask;
}
