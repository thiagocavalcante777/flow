<?php

namespace App\Domain\Model;

class TimeTask
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collaborator
     */
    private $collaborator;

    /**
     * @var Collaborator
     */
    private $systemUser;

    /**
     * @var DateTime
     */
    private $startTime;

    /**
     * @var DateTime|null
     */
    private $endTime;

    /**
     * @var string
     */
    private $status;

    /**
     * @var Project
     */
    private $project;

    /**
     * @var ModelTask
     */
    private $modelTask;

    /**
     * @var string|null
     */
    private ?string $totalTime;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collaborator
     */
    public function getCollaborator(): Collaborator
    {
        return $this->collaborator;
    }

    /**
     * @param Collaborator $collaborator
     */
    public function setCollaborator(Collaborator $collaborator): void
    {
        $this->collaborator = $collaborator;
    }

    /**
     * @return Collaborator
     */
    public function getSystemUser(): Collaborator
    {
        return $this->systemUser;
    }

    /**
     * @param Collaborator $systemUser
     */
    public function setSystemUser(Collaborator $systemUser): void
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
     * @return \DateTime|null
     */
    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    /**
     * @param \DateTime $endTime
     */
    public function setEndTime(?\DateTime $endTime = null): void
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
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @return ModelTask
     */
    public function getModelTask(): ModelTask
    {
        return $this->modelTask;
    }

    /**
     * @param ModelTask $modelTask
     */
    public function setModelTask(ModelTask $modelTask): void
    {
        $this->modelTask = $modelTask;
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

}
