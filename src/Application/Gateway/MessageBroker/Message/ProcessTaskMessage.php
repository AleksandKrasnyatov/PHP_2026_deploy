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

    public function getType(): string
    {
        // TODO: Implement getType() method.
    }

    public function getRoutingKey(): string
    {
        // TODO: Implement getRoutingKey() method.
    }

    public function getPayload(): string
    {
        return (string) json_encode(
            [
                'taskId' => $this->taskId,
                'userName' => $this->userName,
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}
