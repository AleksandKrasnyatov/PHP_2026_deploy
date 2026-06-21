<?php

declare(strict_types=1);

namespace App\Application\UseCase\Task\Query;

use App\Domain\Enum\Status;
use App\Domain\Repository\TaskRepository;
use DomainException;

final readonly class GetTaskStatusHandler
{
    public function __construct(
        public TaskRepository $tasks,
    ) {
    }

    public function handle(GetTaskStatusQuery $query): Status
    {
        $task = $this->tasks->find($query->taskId);
        if (!$task) {
            throw new DomainException('Задача не найдена');
        }

        return $task->getStatus();
    }
}
