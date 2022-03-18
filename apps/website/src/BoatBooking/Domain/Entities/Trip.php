<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\Entities;

use App\BoatBooking\Domain\Enums\TripState;
use App\BoatBooking\Domain\Enums\TripType;
use App\BoatBooking\Domain\ValueObjects\EndDate;
use App\BoatBooking\Domain\ValueObjects\SkipperId;
use App\BoatBooking\Domain\ValueObjects\StartDate;
use App\BoatBooking\Domain\ValueObjects\TripDuration;
use Tests\Domain\BoatBooking\SUTs\BookBoatForTripSUT;

class Trip
{
    public function __construct(private bool $free)
    {
    }

    public function name(): string
    {
        return "Sortie en mer";
    }

    public function isFree(): bool
    {
        return $this->free;
    }

    public function state(): TripState
    {
        return TripState::UNCONFIRMED;
    }

    public function type(): TripType
    {
        return TripType::BOAT_TRIP;
    }

    public function duration(): TripDuration
    {
        return new TripDuration(new StartDate(new \DateTime()), new EndDate(new \DateTime()));
    }

    public function skipperId(): SkipperId
    {
        return new SkipperId(BookBoatForTripSUT::SKIPPER_ID);
    }
}
