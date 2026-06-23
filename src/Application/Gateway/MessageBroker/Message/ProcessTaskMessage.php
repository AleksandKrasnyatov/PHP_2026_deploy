<?php

declare(strict_types=1);

namespace App\Application\Gateway\MessageBroker\Message;

final readonly class ProcessTaskMessage implements MessageInterface
{
    public function __construct(
        public string $taskId,
        public string $userName,
    ) {
    }

    public function getRoutingKey(): string
    {
        return 'task.process';
    }
}
