<?php

namespace App\Infrastructure\Service;

use App\Domain\Persistence\EntityRepository\CollaboratorRepositoryInterface;
use App\Domain\Service\ValidateTimeTaskInterface;
use App\Infrastructure\DataTransferObject\TimeTaskDTO;
use App\Infrastructure\Adapter\RedisClient\RedisClient;

class ValidateTimeTask implements ValidateTimeTaskInterface
{
    private CollaboratorRepositoryInterface $collaboratorRepository;
    private RedisClient $redisClient;

    public function __construct(
        CollaboratorRepositoryInterface $collaboratorRepository,
        RedisClient $redisClient
    )
    {
        $this->collaboratorRepository = $collaboratorRepository;
        $this->redisClient = $redisClient;
    }

    public function validateStartTimeTask(TimeTaskDTO $timeTaskDTO): bool
    {
        $timeTaskStart = [
            'collaborator_id' => $timeTaskDTO->getCollaborator()->getCollaboratorId(),
            'system_user_id' => $timeTaskDTO->getCollaborator()->getSystemUserId(),
            'start_time' => $timeTaskDTO->getStartTime()->format('Y-m-d_H:i')
        ];

        $key = $timeTaskStart['collaborator_id'].'_'.$timeTaskStart['system_user_id'].'_'.$timeTaskStart['start_time'];

        if (!empty($this->isInMemory($key))) {
            return false;
        }

        if ($this->insertInMemory($key, $timeTaskStart)) {
            return true;
        }

        return false;
    }

    private function isInMemory(string $key) : bool
    {
        $isInMemory = $this->redisClient->getArray($key);

        if (!empty($isInMemory)) {
            return true;
        }

        return false;
    }

    private function insertInMemory(string $key,array $timeTaskStart) : bool
    {
        $this->redisClient->setArray($key, $timeTaskStart);

        return true;
    }
}
