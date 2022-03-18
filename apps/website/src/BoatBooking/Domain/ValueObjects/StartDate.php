<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\ValueObjects;

use DateTimeInterface;

class StartDate
{
    public function __construct(public readonly DateTimeInterface $date)
    {
    }
}
