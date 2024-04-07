<?php

/**
 * Class TimeTaskService
 * @package App\Infrastructure\Service
 */


namespace App\Infrastructure\Service;


use App\Domain\Model\Collaborator;
use App\Domain\Model\ModelTask;
use App\Domain\Model\Project;
use App\Domain\Model\TimeTask;
use App\Domain\Persistence\EntityRepository\TimeTaskRepositoryInterface;
use App\Domain\Service\TimeTaskServiceInterface;
use App\Domain\Service\ValidateTimeTaskInterface;
use App\Infrastructure\DataTransferObject\CollaboratorDTO;
use App\Infrastructure\DataTransferObject\ModelTidDTO;
use App\Infrastructure\DataTransferObject\ProjectDTO;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use DateTime;
use function Symfony\Config\em;

class TimeTaskService implements TimeTaskServiceInterface
{
    private TimeTaskRepositoryInterface $timeTaskRepository;
    private CollaboratorDTO $collaborator;
    private ProjectDTO $project;
    private ModelTidDTO $modelTid;
    private TimeTaskDTO $timeTask;
    private ?int $id = null;
    private ?DateTime $startTime = null;
    private ?DateTime $endTime = null;
    private ?string $status;
    private ?string $totalTime = null;
    private ?string $totalTimeService = null;
    private ?string $overTime = null;
    private ?string $pauseTime = null;
    private ?string $nightTime = null;
    private ?string $normalTime = null;
    private ?string $normalTimeWeek = null;
    private ?string $normalOverTimeWeek = null;
    private ?string $normalTimeSaturdayHoliday = null;
    private ?string $normalTimeSunday = null;
    private ?string $nightTimeWeek = null;
    private ?string $nightOverTimeWeek = null;
    private ?string $nightTimeSaturdayHoliday = null;
    private ?string $nightTimeSunday = null;
    private ValidateTimeTaskInterface $validateTimeTask;

    public function __construct(
        TimeTaskRepositoryInterface $timeTaskRepository,
        CollaboratorDTO $collaborator,
        ProjectDTO $project,
        ModelTidDTO $modelTid,
        TimeTaskDTO $timeTask,
        ValidateTimeTaskInterface $validateTimeTask
    )
    {
        $this->timeTaskRepository = $timeTaskRepository;
        $this->collaborator = $collaborator;
        $this->project = $project;
        $this->modelTid = $modelTid;
        $this->timeTask = $timeTask;
        $this->validateTimeTask = $validateTimeTask;
    }

    public function buildTimeTask($timeTaskDTO): TimeTaskDTO {

        $this->id = !empty($this->getId()) ? $this->getId() : $timeTaskDTO->getId();
        $this->timeTask->setId($this->id);

        if (!empty($this->getStartTime())) {
            $this->timeTask->setStartTime($this->getStartTime());
        }

        if (!empty($this->getEndTime())) {
            $this->timeTask->setEndTime($this->getEndTime());
        }

        if (!empty($this->getToTalTime())) {
            $this->timeTask->setTotalTime($this->getToTalTime());
        }

        if (!empty($this->getToTalTimeService())) {
            $this->timeTask->setTotalTimeService($this->getToTalTimeService());
        }

        if (!empty($this->getOverTime())) {
            $this->timeTask->setOverTime($this->getOverTime());
        }

        $this->collaborator = !empty($this->getCollaborator()->getId())
            ? $this->getCollaborator() : $timeTaskDTO->getCollaborator();
        $this->timeTask->setCollaborator($this->collaborator);
        $this->timeTask->setSystemUser($this->collaborator);

        $this->project = !empty($this->getProject()->getId()) ? $this->getProject() : $timeTaskDTO->getProject();
        $this->timeTask->setProject($this->project);

        $this->modelTid = !empty($this->getModelTid()->getId()) ? $this->getModelTid() : $timeTaskDTO->getModelTid();
        $this->timeTask->setModelTid($this->modelTid);

        return $this->timeTask;
    }

    public function buildTimeTaskFromEntity(TimeTask $timeTask): TimeTaskDTO
    {
        $this->setId($timeTask->getId());
        $this->setCollaborator($timeTask->getCollaborator());
        $this->setStartTime($timeTask->getStartTime());
        $this->setProject($timeTask->getProject());
        $this->setModelTid($timeTask->getModelTid());

        $this->timeTask->setId($this->getId());
        $this->timeTask->setCollaborator($this->getCollaborator());
        $this->timeTask->setStartTime($this->getStartTime());
        $this->timeTask->setProject($this->getProject());
        $this->timeTask->setModelTid($this->getModelTid());

        return $this->timeTask;
    }


    public function setCollaborator(Collaborator $collaborator): void
    {
        $this->collaborator->setId($collaborator->getId());
        $this->collaborator->setCollaboratorId($collaborator->getCollaboratorId());
        $this->collaborator->setSystemUserId($collaborator->getSystemUserId());
        $this->collaborator->setName($collaborator->getName());
    }

    public function setProject(Project $project): void
    {
        $this->project->setId($project->getId());
        $this->project->setProjectId($project->getProjectId());
        $this->project->setReference($project->getReference());
        $this->project->setDesignation($project->getDesignation());

    }

    public function setModelTid(ModelTask $modelTid): void
    {
        $this->modelTid->setId($modelTid->getId());;
        $this->modelTid->setModelTidId($modelTid->getModelTidId());;
        $this->modelTid->setDesignation($modelTid->getDesignation());;
    }

    public function getCollaborator(): ?CollaboratorDTO
    {
        return $this->collaborator;
    }

    public function getProject(): ?ProjectDTO
    {
        return $this->project;
    }

    public function getModelTid(): ?ModelTidDTO
    {
        return $this->modelTid;
    }

    public function setId(?int $id) : void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function openedTimeTask(Collaborator $collaborador): ?TimeTask
    {
        $timeTask = $this->timeTaskRepository->findOpened($collaborador);
        return $timeTask;
    }

    public function timesTasksToRectify() : ?array
    {
        $timesTasks = $this->timeTaskRepository->timesTasksToRectify();
        return $timesTasks;
    }

    public function findOpenedById(int $timeTaskId) : ?TimeTask
    {
        $timeTask = $this->timeTaskRepository->findOpenedById($timeTaskId);
        return $timeTask;
    }

    public function startTimeTask(TimeTaskDTO $timeTaskDTO): bool
    {
        $dateTimeNow = new DateTime();
        $timeTaskDTO->setStartTime($dateTimeNow);
        $timeTaskDTO->setStatus('O');

        if (!$this->validateTimeTask->validateStartTimeTask($timeTaskDTO)){
            return false;
        }

        $saveTimeTask =  $this->timeTaskRepository->saveStartTimeTask($timeTaskDTO);
        return $saveTimeTask;
    }

    public function finishingTimeTask(TimeTaskDTO $timeTaskDTO): bool
    {
        $timeTaskDTO->setStatus('C');
        $saveTimeTask = $this->timeTaskRepository->saveFinishingTimeTask($timeTaskDTO);
        return $saveTimeTask;
    }

    public function setStartTime(?DateTime $startTime)
    {
        $this->startTime = $startTime;
    }

    public function getStartTime() : ?DateTime
    {
        return $this->startTime;
    }

    public function setEndTime(?DateTime $endTime = null)
    {
        $this->endTime = $endTime;
    }

    public function getEndTime() : ?DateTime
    {
        return $this->endTime;
    }

    public function timesTasksToMonitor(): ?array
    {
        $timeTaskToMonitor =  $this->timeTaskRepository->timesTasksToMonitor();

        $timesTasksWithTotal = [];

        foreach ($timeTaskToMonitor as $timesTask) {
            $ini = $timesTask['startTime'];
            $end = $timesTask['endTime'] == null ? '' : $timesTask['endTime'];
            $timesTask['total'] = '';

            if ($end) {
                $total = $end->diff($ini)->format("%H:%i");
                $timesTask['total'] = $total;
                $timesTask['endTime'] = $end->format("H:i");
            }

            $timesTask['startTime'] = $ini->format("H:i");

            $timesTasksWithTotal[] = $timesTask;
        }

        return $timesTasksWithTotal;
    }

    public function setTotalTime(?String $totalTime = null)
    {
        $this->totalTime = $totalTime;
    }

    public function getToTalTime(): ?String
    {
        return $this->totalTime;
    }

    public function setTotalTimeService(?string $totalTimeService = null)
    {
        $this->totalTimeService = $totalTimeService;
    }

    public function getToTalTimeService(): ?string
    {
        return $this->totalTimeService;
    }

    public function setPauseTime(?string $pauseTime = null)
    {
        $this->pauseTime = $pauseTime;
    }

    public function getPauseTime(): ?string
    {
       return $this->pauseTime;
    }

    public function setOverTime(?string  $overTime = null)
    {
        $this->overTime = $overTime;
    }

    public function getOverTime(): ?string
    {
        return $this->overTime;
    }

    public function getNightTime(): ?string
    {
        return $this->nightTime;
    }

    public function setNightTime(?string $nightTime): void
    {
        $this->nightTime = $nightTime;
    }

    public function getNormalTime(): ?string
    {
        return $this->normalTime;
    }

    public function setNormalTime(?string $normalTime): void
    {
        $this->normalTime = $normalTime;
    }

    public function getNormalTimeWeek(): ?string
    {
        return $this->normalTimeWeek;
    }

    public function setNormalTimeWeek(?string $normalTimeWeek): void
    {
        $this->normalTimeWeek = $normalTimeWeek;
    }

    public function getNormalOverTimeWeek(): ?string
    {
        return $this->normalOverTimeWeek;
    }

    public function setNormalOverTimeWeek(?string $normalOverTimeWeek): void
    {
        $this->normalOverTimeWeek = $normalOverTimeWeek;
    }

    public function getNormalTimeSaturdayHoliday(): ?string
    {
        return $this->normalTimeSaturdayHoliday;
    }

    public function setNormalTimeSaturdayHoliday(?string $normalTimeSaturdayHoliday): void
    {
        $this->normalTimeSaturdayHoliday = $normalTimeSaturdayHoliday;
    }

    public function getNormalTimeSunday(): ?string
    {
        return $this->normalTimeSunday;
    }

    public function setNormalTimeSunday(?string $normalTimeSunday): void
    {
        $this->normalTimeSunday = $normalTimeSunday;
    }

    public function getNightTimeWeek(): ?string
    {
        return $this->nightTimeWeek;
    }

    public function setNightTimeWeek(?string $nightTimeWeek): void
    {
        $this->nightTimeWeek = $nightTimeWeek;
    }

    public function getNightOverTimeWeek(): ?string
    {
        return $this->nightOverTimeWeek;
    }

    public function setNightOverTimeWeek(?string $nightOverTimeWeek): void
    {
        $this->nightOverTimeWeek = $nightOverTimeWeek;
    }

    public function getNightTimeSaturdayHoliday(): ?string
    {
        return $this->nightTimeSaturdayHoliday;
    }

    public function setNightTimeSaturdayHoliday(?string $nightTimeSaturdayHoliday): void
    {
        $this->nightTimeSaturdayHoliday = $nightTimeSaturdayHoliday;
    }

    public function getNightTimeSunday(): ?string
    {
        return $this->nightTimeSunday;
    }

    public function setNightTimeSunday(?string $nightTimeSunday): void
    {
        $this->nightTimeSunday = $nightTimeSunday;
    }
}
