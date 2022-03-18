<?php

declare(strict_types=1);

namespace Tests\Domain\BoatBooking\SUTs;

use App\BoatBooking\Domain\Enums\TripState;
use App\BoatBooking\Domain\UseCases\BookBoatForTrip\BookBoatForTrip;
use App\BoatBooking\Domain\UseCases\BookBoatForTrip\BookBoatForTripRequest;
use Tests\Domain\BoatBooking\Adapters\Presenters\BookBoatForTripTestPresenter;

class BookBoatForTripSUT
{
    public const STAFF_ID = '5527b399-d228-4526-bc52-7a8871ec1dea';
    public const SKIPPER_ID = '2428314c-2a99-4d2f-814d-4a01b420dec1';

    public BookBoatForTripRequest $request;
    public BookBoatForTripTestPresenter $presenter;
    public BookBoatForTrip $useCase;

    private bool $isFree;
    private string $role;
    private string $skipperId;
    private string $userId;
    private TripState $state;

    public function __construct()
    {
        $this->isFree = true;
        $this->state = TripState::UNCONFIRMED;
    }

    public static function new(): BookBoatForTripSUT
    {
        return new self();
    }

    public function chargedTrip(): BookBoatForTripSUT
    {
        $this->isFree = false;

        return $this;
    }

    public function free(): BookBoatForTripSUT
    {
        $this->isFree = true;

        return $this;
    }

    public function asSkipper(): BookBoatForTripSUT
    {
        $this->userId = self::SKIPPER_ID;
        $this->skipperId = self::SKIPPER_ID;
        $this->role = 'skipper';

        return $this;
    }

    public function asStaffMember(): BookBoatForTripSUT
    {
        $this->userId = self::STAFF_ID;
        $this->skipperId = self::SKIPPER_ID;
        $this->role = 'staff';

        return $this;
    }

    public function build(): BookBoatForTripSUT
    {
        $this->request = new BookBoatForTripRequest(
            free: $this->isFree,
            userRole: $this->role,
            state: $this->state->value,
            userId: $this->userId,
            skipperId: $this->skipperId,
        );
        $this->presenter = new BookBoatForTripTestPresenter();
        $this->useCase = new BookBoatForTrip();

        return $this;
    }

    public function run(): BookBoatForTripSUT
    {
        $this->useCase->executes($this->presenter, $this->request);

        return $this;
    }

    public function confirmed(): BookBoatForTripSUT
    {
        $this->state = TripState::PLANNED;

        return $this;
    }
}
