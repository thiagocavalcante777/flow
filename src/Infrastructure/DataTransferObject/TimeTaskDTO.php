<?php

/**
 * Class TimeTaskDTO
 * @package App\Infrastructure\DataTransferObject
 */

namespace App\Infrastructure\DataTransferObject;

use DateTime;

class TimeTaskDTO
{
    private $id;

    /**
     * @var CollaboratorDTO
     */
    private $collaborator;

    /**
     * @var CollaboratorDTO
     */
    private $systemUser;

    /**
     * @var \DateTime
     */
    private $startTime;

    /**
     * @var null|DateTime
     */
    private $endTime;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ProjectDTO
     */
    private $project;

    /**
     * @var ModelTidDTO
     */
    private $modelTid;

    /**
     * @var string|null
     */
    private ?string $totalTime;

    /**
     * @var string|null
     */
    private ?string $totalTimeService;

    /**
     * @var string|null
     */
    private ?string $overTime;

    /**
     * @var string|null
     */
    private ?string $pauseTime;

    /**
     * @var string|null
     */
    private ?string $justifyOverTime;

    /**
     * @var string|null
     */
    private ?string $nightTime;

    /**
     * @var string|null
     */
    private ?string $normalTime;

    /**
     * @var string|null
     */
    private ?string $normalTimeWeek;

    /**
     * @var string|null
     */
    private ?string $normalOverTimeWeek;

    /**
     * @var string|null
     */
    private ?string $normalTimeSaturdayHoliday;

    /**
     * @var string|null
     */
    private ?string $normalTimeSunday;

    /**
     * @var string|null
     */
    private ?string $nightTimeWeek;

    /**
     * @var string|null
     */
    private ?string $nightOverTimeWeek;

    /**
     * @var string|null
     */
    private ?string $nightTimeSaturdayHoliday;

    /**
     * @var string|null
     */
    private ?string $nightTimeSunday;


    public function setId($id) : void
    {
        $this->id = (int) $id;
    }

    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * @return CollaboratorDTO
     */
    public function getCollaborator(): CollaboratorDTO
    {
        return $this->collaborator;
    }

    /**
     * @param CollaboratorDTO
     */
    public function setCollaborator(CollaboratorDTO $collaborator): void
    {
        $this->collaborator = $collaborator;
    }

    /**
     * @return CollaboratorDTO
     */
    public function getSystemUser(): CollaboratorDTO
    {
        return $this->systemUser;
    }

    /**
     * @param CollaboratorDTO $systemUser
     */
    public function setSystemUser(CollaboratorDTO $systemUser): void
    {
        $this->systemUser = $systemUser;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $startTime
     */
    public function setStartTime(\DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return ?DateTime
     */
    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    /**
     * @param ?DateTime $endTime
     */
    public function setEndTime(?DateTime $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return ProjectDTO
     */
    public function getProject(): ProjectDTO
    {
        return $this->project;
    }

    /**
     * @param ProjectDTO $project
     */
    public function setProject(ProjectDTO $project): void
    {
        $this->project = $project;
    }

    /**
     * @return ModelTidDTO
     */
    public function getModelTid(): ModelTidDTO
    {
        return $this->modelTid;
    }

    /**
     * @param ModelTidDTO $modelTid
     */
    public function setModelTid(ModelTidDTO $modelTid): void
    {
        $this->modelTid = $modelTid;
    }

    /**
     * @return string|null
     */
    public function getTotalTime(): ?string
    {
        return $this->totalTime;
    }

    /**
     * @param string|null $totalTime
     */
    public function setTotalTime(?string $totalTime): void
    {
        $this->totalTime = $totalTime;
    }

    /**
     * @return string|null
     */
    public function getTotalTimeService(): ?string
    {
        return $this->totalTimeService;
    }

    /**
     * @param string|null $totalTimeService
     */
    public function setTotalTimeService(?string $totalTimeService): void
    {
        $this->totalTimeService = $totalTimeService;
    }

    /**
     * @return string|null
     */
    public function getOverTime(): ?string
    {
        return $this->overTime;
    }

    /**
     * @param string|null $overTime
     */
    public function setOverTime(?string $overTime): void
    {
        $this->overTime = $overTime;
    }

    /**
     * @return string|null
     */
    public function getPauseTime(): ?string
    {
        return $this->pauseTime;
    }

    /**
     * @param string|null $pauseTime
     */
    public function setPauseTime(?string $pauseTime): void
    {
        $this->pauseTime = $pauseTime;
    }

    /**
     * @return string|null
     */
    public function getJustifyOverTime(): ?string
    {
        return $this->justifyOverTime;
    }

    /**
     * @param string|null $justifyOverTime
     */
    public function setJustifyOverTime(?string $justifyOverTime): void
    {
        $this->justifyOverTime = $justifyOverTime;
    }

    /**
     * @return string|null
     */
    public function getNightTime(): ?string
    {
        return $this->nightTime;
    }

    /**
     * @param string|null $nightTime
     */
    public function setNightTime(?string $nightTime): void
    {
        $this->nightTime = $nightTime;
    }

    /**
     * @return string|null
     */
    public function getNormalTime(): ?string
    {
        return $this->normalTime;
    }

    /**
     * @param string|null $normalTime
     */
    public function setNormalTime(?string $normalTime): void
    {
        $this->normalTime = $normalTime;
    }

    /**
     * @return string|null
     */
    public function getNormalTimeWeek(): ?string
    {
        return $this->normalTimeWeek;
    }

    /**
     * @param string|null $normalTimeWeek
     */
    public function setNormalTimeWeek(?string $normalTimeWeek): void
    {
        $this->normalTimeWeek = $normalTimeWeek;
    }

    /**
     * @return string|null
     */
    public function getNormalOverTimeWeek(): ?string
    {
        return $this->normalOverTimeWeek;
    }

    /**
     * @param string|null $normalOverTimeWeek
     */
    public function setNormalOverTimeWeek(?string $normalOverTimeWeek): void
    {
        $this->normalOverTimeWeek = $normalOverTimeWeek;
    }

    /**
     * @return string|null
     */
    public function getNormalTimeSaturdayHoliday(): ?string
    {
        return $this->normalTimeSaturdayHoliday;
    }

    /**
     * @param string|null $normalTimeSaturdayHoliday
     */
    public function setNormalTimeSaturdayHoliday(?string $normalTimeSaturdayHoliday): void
    {
        $this->normalTimeSaturdayHoliday = $normalTimeSaturdayHoliday;
    }

    /**
     * @return string|null
     */
    public function getNormalTimeSunday(): ?string
    {
        return $this->normalTimeSunday;
    }

    /**
     * @param string|null $normalTimeSunday
     */
    public function setNormalTimeSunday(?string $normalTimeSunday): void
    {
        $this->normalTimeSunday = $normalTimeSunday;
    }

    /**
     * @return string|null
     */
    public function getNightTimeWeek(): ?string
    {
        return $this->nightTimeWeek;
    }

    /**
     * @param string|null $nightTimeWeek
     */
    public function setNightTimeWeek(?string $nightTimeWeek): void
    {
        $this->nightTimeWeek = $nightTimeWeek;
    }

    /**
     * @return string|null
     */
    public function getNightOverTimeWeek(): ?string
    {
        return $this->nightOverTimeWeek;
    }

    /**
     * @param string|null $nightOverTimeWeek
     */
    public function setNightOverTimeWeek(?string $nightOverTimeWeek): void
    {
        $this->nightOverTimeWeek = $nightOverTimeWeek;
    }

    /**
     * @return string|null
     */
    public function getNightTimeSaturdayHoliday(): ?string
    {
        return $this->nightTimeSaturdayHoliday;
    }

    /**
     * @param string|null $nightTimeSaturdayHoliday
     */
    public function setNightTimeSaturdayHoliday(?string $nightTimeSaturdayHoliday): void
    {
        $this->nightTimeSaturdayHoliday = $nightTimeSaturdayHoliday;
    }

    /**
     * @return string|null
     */
    public function getNightTimeSunday(): ?string
    {
        return $this->nightTimeSunday;
    }

    /**
     * @param string|null $nightTimeSunday
     */
    public function setNightTimeSunday(?string $nightTimeSunday): void
    {
        $this->nightTimeSunday = $nightTimeSunday;
    }
}
