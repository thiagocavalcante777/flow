<?php

namespace App\Domain\Service;

use App\Domain\Model\Collaborator;
use App\Domain\Model\ModelTask;
use App\Domain\Model\Project;
use App\Infrastructure\DataTransferObject\CollaboratorDTO;
use App\Infrastructure\DataTransferObject\ModelTidDTO;
use App\Infrastructure\DataTransferObject\ProjectDTO;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use App\Domain\Model\TimeTask;
use DateTime;

interface TimeTaskServiceInterface
{
    public function buildTimeTask(TimeTaskDTO $timeTaskDTO) : TimeTaskDTO;

    public function buildTimeTaskFromEntity(TimeTask $timeTask) : TimeTaskDTO;

    public function openedTimeTask(Collaborator $collaborador) : ?TimeTask;

    public function findOpenedById(int $timeTaskId) : ?TimeTask;

    public function timesTasksToRectify() : ?array;

    public function timesTasksToMonitor() : ?array;

    public function setCollaborator(Collaborator $collaborator) : void;

    public function setProject(Project $project) : void;

    public function setModelTid(ModelTask $modelTid) : void;

    public function getCollaborator() : ?CollaboratorDTO;

    public function getProject() : ?ProjectDTO;

    public function getModelTid() : ?ModelTidDTO;

    public function startTimeTask(TimeTaskDTO $timeTaskDTO) : bool;

    public function setStartTime(?DateTime $startTime);

    public function getStartTime() : ?DateTime;

    public function setEndTime(?DateTime $endTime = null);

    public function getEndTime() : ?DateTime;

    public function setTotalTime(?string $totalTime = null);

    public function getToTalTime() : ?string;

    public function setTotalTimeService(?string $totalTimeService = null);

    public function getToTalTimeService() : ?string;

    public function setPauseTime(?string $pauseTime = null);

    public function getPauseTime() : ?string;

    public function setOverTime(?string $overTime = null);

    public function getOverTime() : ?string;

    public function getNightTime(): ?string;

    public function setNightTime(?string $nightTime): void;

    public function getNormalTime(): ?string;

    public function setNormalTime(?string $normalTime): void;

    public function getNormalTimeWeek(): ?string;

    public function setNormalTimeWeek(?string $normalTimeWeek): void;

    public function getNormalOverTimeWeek(): ?string;

    public function setNormalOverTimeWeek(?string $normalOverTimeWeek): void;

    public function getNormalTimeSaturdayHoliday(): ?string;

    public function setNormalTimeSaturdayHoliday(?string $normalTimeSaturdayHoliday): void;

    public function getNormalTimeSunday(): ?string;

    public function setNormalTimeSunday(?string $normalTimeSunday): void;

    public function getNightTimeWeek(): ?string;

    public function setNightTimeWeek(?string $nightTimeWeek): void;

    public function getNightOverTimeWeek(): ?string;

    public function setNightOverTimeWeek(?string $nightOverTimeWeek): void;

    public function getNightTimeSaturdayHoliday(): ?string;

    public function setNightTimeSaturdayHoliday(?string $nightTimeSaturdayHoliday): void;

    public function getNightTimeSunday(): ?string;

    public function setNightTimeSunday(?string $nightTimeSunday): void;

    public function finishingTimeTask(TimeTaskDTO $timeTaskDTO) : bool;
}
