<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Enum\Status;
use App\Domain\ValueObject\Id;

final class Task
{
    public function __construct(
        public readonly Id $id,
        private Status $status,
    ) {
    }

    public static function new(): self
    {
        return new self(
            Id::generate(),
            Status::Created
        );
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
