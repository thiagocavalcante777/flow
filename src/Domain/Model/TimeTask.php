<?php

namespace App\Domain\Model;

use DateTime;

class TimeTask
{
    private int $id;

    private Collaborator $collaborator;

    private Collaborator $systemUser;

    private DateTime $startTime;

    private ?DateTime $endTime;

    private string $status;

    private Project $project;

    private ModelTask $modelTask;

    private ?string $totalTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCollaborator(): Collaborator
    {
        return $this->collaborator;
    }

    public function setCollaborator(Collaborator $collaborator): void
    {
        $this->collaborator = $collaborator;
    }

    public function getSystemUser(): Collaborator
    {
        return $this->systemUser;
    }

    public function setSystemUser(Collaborator $systemUser): void
    {
        $this->systemUser = $systemUser;
    }

    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTime $endTime = null): void
    {
        $this->endTime = $endTime;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    public function getModelTask(): ModelTask
    {
        return $this->modelTask;
    }

    public function setModelTask(ModelTask $modelTask): void
    {
        $this->modelTask = $modelTask;
    }

    public function getTotalTime(): ?string
    {
        return $this->totalTime;
    }

    public function setTotalTime(?string $totalTime): void
    {
        $this->totalTime = $totalTime;
    }
}
