<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\UseCases\BookBoatForTrip;

use App\BoatBooking\Domain\Aggregates\Trip;

interface BookBoatForTripPresenter
{
    public function boatBooked(Trip $trip): void;

    public function userIsNotAllowedToBookBoat(): void;
}
