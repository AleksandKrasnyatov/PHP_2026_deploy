<?php

namespace App\Application\Gateway\MessageBroker\Message;

interface MessageHandlerInterface
{
    public function supports(string $type): bool;
    public function handle(array $payload): void;
}
