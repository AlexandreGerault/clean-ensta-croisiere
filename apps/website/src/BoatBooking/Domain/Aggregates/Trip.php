<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\Aggregates;

use App\BoatBooking\Domain\Entities\Trip as TripEntity;

class Trip
{
    public function __construct(private TripEntity $rootEntity)
    {
    }

    public function root(): TripEntity
    {
        return $this->rootEntity;
    }
}
