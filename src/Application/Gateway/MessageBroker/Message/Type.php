<?php

declare(strict_types=1);

namespace App\Application\Gateway\MessageBroker\Message;

enum Type: string
{
    case Task = 'task';
}
