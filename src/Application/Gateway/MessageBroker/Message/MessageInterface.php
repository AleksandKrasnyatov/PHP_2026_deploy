<?php

namespace App\Application\Gateway\MessageBroker\Message;

interface MessageInterface
{
    public function getType(): string;
    public function getRoutingKey(): string;
    public function getPayload(): string;
}
