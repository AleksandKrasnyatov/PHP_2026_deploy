<?php

declare(strict_types=1);

namespace Test\Unit\Domain\Entity;

use App\Domain\Entity\Task;
use App\Domain\Enum\Status;
use App\Domain\ValueObject\Id;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testSuccess(): void
    {
        $task = new Task($id = Id::generate(), $status = Status::InProgress);

        self::assertEquals($id, $task->id);
        self::assertEquals($status, $task->getStatus());
    }

    public function testNew(): void
    {
        $task = Task::new();

        self::assertNotEmpty($task->id);
        self::assertEquals(Status::Created, $task->getStatus());
    }
}
