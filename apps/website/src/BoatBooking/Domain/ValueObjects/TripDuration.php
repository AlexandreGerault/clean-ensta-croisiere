<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\ValueObjects;

class TripDuration
{
    public function __construct(private StartDate $startDate, private EndDate $endDate)
    {
        if ($this->startDate->date->diff($this->endDate->date)->invert === 1) {
            throw new \InvalidArgumentException('The start date must be before the end date');
        }
    }

    public function start(): StartDate
    {
        return $this->startDate;
    }

    public function end(): EndDate
    {
        return $this->endDate;
    }
}
