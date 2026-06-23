<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Task;
use App\Domain\Enum\Status;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\ValueObject\Id;
use Predis\Client;

final class TaskRepository implements TaskRepositoryInterface
{
    private const string KEY_PREFIX = 'task:';

    public function __construct(
        private readonly Client $redis
    ) {
    }

    public function find(Id $id): ?Task
    {
        $payload = $this->redis->get($this->key($id));

        $data = json_decode($payload, true);

        return new Task($id, Status::from($data['status']));
    }

    public function save(Task $task): void
    {
        $this->redis->set($this->key($task->id), json_encode([
            'status' => $task->getStatus()->name,
        ]));
    }

    private function key(Id $id): string
    {
        return self::KEY_PREFIX . $id->value;
    }
}
