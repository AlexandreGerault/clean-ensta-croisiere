<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\ValueObjects;

use DateTimeInterface;

class EndDate
{
    public function __construct(public readonly DateTimeInterface $date)
    {
    }
}
