<?php

/**
 * Class TimeTaskRepository
 * @package App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\PromaintFactory
 */

namespace App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\Flow;

use App\Domain\Model\Collaborator;
use App\Domain\Model\ModelTask;
use App\Domain\Model\Project;
use App\Domain\Model\TimeTask;
use App\Domain\Persistence\EntityRepository\TimeTaskRepositoryInterface;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use App\Infrastructure\Persistence\Doctrine\ServiceEntityRepository\AbstractServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\OrderBy;
use function Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;

class TimeTaskRepository extends AbstractServiceEntityRepository implements
TimeTaskRepositoryInterface
{

    public function __construct( EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, TimeTask::class);
    }

    /**
     * @param string $keyField
     * @param string $valueField
     * @param OrderBy|null $orderBy
     * @param Criteria|null $criteria
     * @return array
     */
    public function resultArray(
        string $keyField,
        string $valueField,
        OrderBy $orderBy = null,
        Criteria $criteria = null
    ): array {

    }

    public function saveStartTimeTask(TimeTaskDTO $timeTaskDTO): bool
    {
            $connection = $this->_em->getConnection();
            $query = "
                INSERT INTO time_task (collaborator_id, system_user_id, project_id, model_task_id, start_time,status)
                VALUES(
                {$timeTaskDTO->getCollaborator()->getCollaboratorId()},
                {$timeTaskDTO->getCollaborator()->getSystemUserId()},
                {$timeTaskDTO->getProject()->getProjectId()},
                {$timeTaskDTO->getModelTid()->getModelTidId()},
                '{$timeTaskDTO->getStartTime()->format('Y-m-d H:i:s')}',
                '{$timeTaskDTO->getStatus()}'
                );
            ";

          $connection->executeQuery($query);

          return true;
    }

    public function saveFinishingTimeTask(TimeTaskDTO $timeTaskDTO): bool
    {
        $connection = $this->_em->getConnection();
        $query = "
                UPDATE time_task 
                SET end_time = '{$timeTaskDTO->getEndTime()->format('Y-m-d H:i:s')}',
                total_time = '{$timeTaskDTO->getTotalTime()}',
                total_time_service = '{$timeTaskDTO->getTotalTimeService()}',
                pause_time = '{$timeTaskDTO->getPauseTime()}',
                over_time = '{$timeTaskDTO->getOverTime()}',
                night_time = '{$timeTaskDTO->getNightTime()}',
                normal_time = '{$timeTaskDTO->getNormalTime()}',
                normal_time_week = '{$timeTaskDTO->getNormalTimeWeek()}',
                normal_over_time_week = '{$timeTaskDTO->getNormalOverTimeWeek()}',
                normal_time_saturday_holiday = '{$timeTaskDTO->getNormalTimeSaturdayHoliday()}',
                normal_time_sunday = '{$timeTaskDTO->getNormalTimeSunday()}',
                night_time_week = '{$timeTaskDTO->getNightTimeWeek()}',
                night_over_time_week = '{$timeTaskDTO->getNightOverTimeWeek()}',
                night_time_saturday_holiday = '{$timeTaskDTO->getNightTimeSaturdayHoliday()}',
                night_time_sunday = '{$timeTaskDTO->getNightTimeSunday()}',
                justify_over_time = '{$timeTaskDTO->getJustifyOverTime()}',
                status = '{$timeTaskDTO->getStatus()}'
                WHERE id = {$timeTaskDTO->getId()}
                ;
            ";

        $connection->executeQuery($query);

        return true;
    }

    public function findOpened(Collaborator $collaborator): ?TimeTask
    {
        return $this->findOneBy(['status' => 'O','systemUser' => $collaborator]);
    }

    public function findOpenedById($timeTaskId) : ?TimeTask
    {
        return $this->findOneBy(['status' => 'O','id' => $timeTaskId]);
    }

    public function findLastClosed(Collaborator $collaborator): TimeTask
    {
        return $this->findOneBy(['status' => 'C','systemUser' => $collaborator]);
    }

    public function findOpenedAll() : ?array
    {
        return $this->findBy(['status' => 'O']);
    }

    public function timesTasksToRectify(): ?array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(
            '
            t.id as id, 
            t.startTime as startTime,
            t.endTime as endTime,
            c.collaboratorId as collaboratorId,   
            c.name as collaboratorName,
            p.reference as projectReference,    
            m.designation as modelTidDesignation        
            '
        )
            ->from(TimeTask::class,'t')
            ->join(Collaborator::class,'c',Expr\Join::WITH,'t.collaborator = c.collaboratorId')
            ->join(Project::class,'p',Expr\Join::WITH,'t.project = p.projectId')
            ->join(ModelTask::class,'m',Expr\Join::WITH,'t.modelTid = m.modelTidId')
            ->where('t.status = :status')
            ->andWhere('DATE(t.startTime) < :atualDate')
            ->setParameter(':status','O')
            ->setParameter(':atualDate',date('Y-m-d'));

        return $queryBuilder->getQuery()->getArrayResult();
    }

    public function timesTasksToMonitor(): ?array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select(
            '
            t.id AS id, 
            t.startTime AS startTime,
            t.endTime AS endTime,
            t.status AS status,
            t.totalTimeService as totalTimeService,
            c.collaboratorId as collaboratorId,   
            c.name as collaboratorName,
            p.reference as projectReference,    
            m.designation as modelTaskDesignation
            '
        )
            ->from(TimeTask::class,'t')
            ->join(Collaborator::class,'c',Expr\Join::WITH,'t.collaborator = c.collaboratorId')
            ->join(Project::class,'p',Expr\Join::WITH,'t.project = p.projectId')
            ->join(ModelTask::class,'m',Expr\Join::WITH,'t.modelTask = m.modelTaskId')
            ->where("t.status in ('O','C','S') ")
            ->andWhere('YEAR(t.startTime) = :year')
            ->andWhere('MONTH(t.startTime) = :month')
            ->andWhere('DAY(t.startTime) = :day')
            ->setParameter(':year',date('Y'))
            ->setParameter(':month',date('m'))
            ->setParameter(':day',date('d'))
            ->orderBy('t.status','ASC');

        $timesTasks = $queryBuilder->getQuery()->getArrayResult();

        return $timesTasks;
    }
}
