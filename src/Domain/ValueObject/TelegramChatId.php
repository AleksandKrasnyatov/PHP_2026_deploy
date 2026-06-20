<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Webmozart\Assert\Assert;

class TelegramChatId
{
    public int $value {
        get {
            return $this->value;
        }
        set {
            $this->value = $value;
        }
    }

    public function __construct(int $value)
    {
        Assert::positiveInteger($value, 'Id чата должно быть больше 0');
        $this->value = $value;
    }
}
