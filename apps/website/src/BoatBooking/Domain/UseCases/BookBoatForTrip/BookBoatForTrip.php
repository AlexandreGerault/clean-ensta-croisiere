<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\UseCases\BookBoatForTrip;

use App\BoatBooking\Domain\Aggregates\Trip;
use App\BoatBooking\Domain\Entities\Trip as TripEntity;
use App\BoatBooking\Domain\Enums\TripState;

class BookBoatForTrip
{
    public function executes(BookBoatForTripPresenter $presenter, BookBoatForTripRequest $request): void
    {
        if ($request->userRole === "skipper" && $request->free) {
            $presenter->userIsNotAllowedToBookBoat();
            return;
        }

        if ($request->userRole === "skipper" && $request->state === TripState::PLANNED->value) {
            $presenter->userIsNotAllowedToBookBoat();
            return;
        }

        $rootEntity = new TripEntity($request->free);
        $trip = new Trip($rootEntity);
        $presenter->boatBooked($trip);
    }
}
