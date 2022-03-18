<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\UseCases\BookBoatForTrip;

class BookBoatForTripRequest
{
    private string $userId;
    private string $skipperId;

    public function __construct(
        public readonly bool $free,
        public readonly string $userRole,
        public readonly string $state,
        string $userId,
        string $skipperId
    ) {
        $this->userId = $userId;
        $this->skipperId = $skipperId;
    }
}
