<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\ValueObjects;

class SkipperId
{
    public function __construct(public readonly string $value)
    {
    }
}
