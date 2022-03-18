<?php

declare(strict_types=1);

namespace Tests\Domain\BoatBooking\Adapters\Presenters;

use App\BoatBooking\Domain\Aggregates\Trip;
use App\BoatBooking\Domain\UseCases\BookBoatForTrip\BookBoatForTripPresenter;
use App\BoatBooking\Domain\UseCases\BookBoatForTrip\BookBoatForTripResponse;

class BookBoatForTripTestPresenter implements BookBoatForTripPresenter
{
    private BookBoatForTripResponse $response;

    public function response(): BookBoatForTripResponse
    {
        return $this->response;
    }

    public function boatBooked(Trip $trip): void
    {
        $this->response = new BookBoatForTripResponse($trip);
    }

    public function userIsNotAllowedToBookBoat(): void
    {
        throw new \RuntimeException("User is not allowed to book the boat");
    }
}
