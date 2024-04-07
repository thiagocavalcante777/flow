<?php

/**
 * Class ProcessBarCodeService
 * @package App\Infrastructure\Service
 */

namespace App\Infrastructure\Service;

use App\Domain\Service\CollaboratorProcessBarCodeServiceInterface;
use App\Domain\Service\ModelTidProcessBarCodeServiceInterface;
use App\Domain\Service\ProcessBarCodeServiceInterface;
use App\Domain\Service\ProjectProcessBarCodeServiceInterface;
use App\Domain\Service\TimeTaskServiceInterface;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use stdClass;
use DateTime;
use DateTimeZone;

class ProcessBarCodeService implements ProcessBarCodeServiceInterface
{
    private CollaboratorProcessBarCodeServiceInterface $collaboratorProcessBarCodeService;
    private ModelTidProcessBarCodeServiceInterface $modelTidProcessBarCodeService;
    private ProjectProcessBarCodeServiceInterface $projectProcessBarCodeService;
    private TimeTaskServiceInterface $timeTaskService;

    public function __construct(
        CollaboratorProcessBarCodeServiceInterface $collaboratorProcessBarCodeService,
        ModelTidProcessBarCodeServiceInterface $modelTidProcessBarCodeService,
        ProjectProcessBarCodeServiceInterface $projectProcessBarCodeService,
        TimeTaskServiceInterface $timeTaskService,
    )
    {
        $this->collaboratorProcessBarCodeService = $collaboratorProcessBarCodeService;
        $this->modelTidProcessBarCodeService = $modelTidProcessBarCodeService;
        $this->projectProcessBarCodeService = $projectProcessBarCodeService;
        $this->timeTaskService = $timeTaskService;
    }

    public function processBarCode(string $barCodeString, TimeTaskDTO $timeTaskDto) : TimeTaskDTO
    {
        $objectBarCodeString = $this->resolveBarCodeString($barCodeString);

        if ($objectBarCodeString->type == 'collaborator') {
            $collaborator = $this->collaboratorProcessBarCodeService->findById($objectBarCodeString->id);
            $timeTaskOpened = $this->openedTimeTask($collaborator, $timeTaskDto);

            if ($timeTaskOpened) {
                return $timeTaskOpened;
            }
        }

        $newTimeTask = $this->newTimeTask($objectBarCodeString, $timeTaskDto);

        return $newTimeTask;
    }

    public function newTimeTask($objectBarCodeString, $timeTaskDto)
    {
        switch ($objectBarCodeString->type) {
            case 'collaborator':
                $collaborator = $this->collaboratorProcessBarCodeService->findById($objectBarCodeString->id);
                $this->timeTaskService->setCollaborator($collaborator);
                break;
            case 'project':
                $project = $this->projectProcessBarCodeService->findById($objectBarCodeString->id);
                $this->timeTaskService->setProject($project);
                break;
            case 'model_task':
                $modelTid = $this->modelTidProcessBarCodeService->findById($objectBarCodeString->id);
                $this->timeTaskService->setModelTid($modelTid);
                break;
        }

        return $this->timeTaskService->buildTimeTask($timeTaskDto);
    }

    public function openedTimeTask($collaborator, $timeTaskDto)
    {
        $timeTaskOpened = $this->timeTaskService->openedTimeTask($collaborator);

        if ($timeTaskOpened) {
            $endTimeTask = new DateTime('now');
            $totalTime = $timeTaskOpened->getStartTime()->diff($endTimeTask);
            $this->timeTaskService->setId($timeTaskOpened->getId());
            $this->timeTaskService->setCollaborator($timeTaskOpened->getCollaborator());
            $this->timeTaskService->setProject($timeTaskOpened->getProject());
            $this->timeTaskService->setModelTid($timeTaskOpened->getModelTid());
            $this->timeTaskService->setStartTime($timeTaskOpened->getStartTime());
            $this->timeTaskService->setEndTime($endTimeTask);
            $this->timeTaskService->setTotalTime($totalTime->format("%H:%i"));
            $this->timeTaskService->setTotalTimeService($totalTime->format("%H:%i"));

            return $this->timeTaskService->buildTimeTask($timeTaskDto);
        }

        return null;
    }

    public function resolveBarCodeString(string $barCodeString)
    {
        $stdObj = new stdClass();
        list($type, $id) = explode("-",$barCodeString);

        $stdObj->type = $type;
        $stdObj->id = $id;

        return $stdObj;
    }
}
