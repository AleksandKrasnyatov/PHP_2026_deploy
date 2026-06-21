<?php

declare(strict_types=1);

namespace App\Application\Gateway\MessageBroker\Message;

use App\Domain\ValueObject\Id;

final readonly class ProcessTaskCommand implements MessageInterface
{
    public function __construct(
        public Id $taskId,
        public string $userName,
    ) {
    }

    public function getType(): string
    {
        // TODO: Implement getType() method.
    }

    public function getRoutingKey(): string
    {
        // TODO: Implement getRoutingKey() method.
    }
}
