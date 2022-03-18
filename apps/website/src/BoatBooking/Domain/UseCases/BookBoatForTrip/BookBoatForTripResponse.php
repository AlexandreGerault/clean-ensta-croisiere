<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\UseCases\BookBoatForTrip;

use App\BoatBooking\Domain\Aggregates\Trip;

class BookBoatForTripResponse
{
    public function __construct(private Trip $trip)
    {
    }

    public function trip(): Trip
    {
        return $this->trip;
    }
}
