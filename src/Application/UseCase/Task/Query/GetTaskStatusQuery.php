<?php

declare(strict_types=1);

namespace App\Application\UseCase\Task\Query;

use App\Domain\ValueObject\Id;

final readonly class GetTaskStatusQuery
{
    public function __construct(public Id $taskId)
    {
    }
}
