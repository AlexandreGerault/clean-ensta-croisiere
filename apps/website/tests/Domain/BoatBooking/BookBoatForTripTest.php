<?php

use App\BoatBooking\Domain\Aggregates\Trip;
use App\BoatBooking\Domain\Enums\TripState;
use App\BoatBooking\Domain\Enums\TripType;
use App\BoatBooking\Domain\ValueObjects\EndDate;
use App\BoatBooking\Domain\ValueObjects\StartDate;
use Tests\Domain\BoatBooking\SUTs\BookBoatForTripSUT;

it("allows a skipper to book the boat for a charged trip", function () {
    $testCase = BookBoatForTripSUT::new()
        ->asSkipper()
        ->chargedTrip()
        ->build()
        ->run();

    $trip = $testCase->presenter->response()->trip();

    expect($trip)->toBeInstanceOf(Trip::class);
    expect($trip->root()->name())->toBe("Sortie en mer");
    expect($trip->root()->isFree())->toBeFalse();
    expect($trip->root()->state())->toBe(TripState::UNCONFIRMED);
    expect($trip->root()->type())->toBe(TripType::BOAT_TRIP);
    expect($trip->root()->duration()->start())->toBeInstanceOf(StartDate::class);
    expect($trip->root()->duration()->end())->toBeInstanceOf(EndDate::class);
    expect($trip->root()->skipperId()->value)->toBe(BookBoatForTripSUT::SKIPPER_ID);
});

it("forbids a skipper to book the boat for a free trip", function () {
    BookBoatForTripSUT::new()->asSkipper()->free()->build()->run();
})->throws("User is not allowed to book the boat");

it("forbids a skipper to book the boat for a confirmed trip", function () {
    $testCase = BookBoatForTripSUT::new()->asSkipper()->chargedTrip()->confirmed()->build()->run();
})->throws("User is not allowed to book the boat");

it("allows a staff member to book the boat for a free trip", function () {
    $testCase = BookBoatForTripSUT::new()->asStaffMember()->free()->build()->run();

    $trip = $testCase->presenter->response()->trip();

    expect($trip)->toBeInstanceOf(Trip::class);
    expect($trip->root()->name())->toBe("Sortie en mer");
    expect($trip->root()->isFree())->toBeTrue();
    expect($trip->root()->skipperId()->value)->toBe(BookBoatForTripSUT::SKIPPER_ID);
});

it("allows a staff member to book the boat for a charged trip", function () {
    $testCase = BookBoatForTripSUT::new()->asStaffMember()->chargedTrip()->build()->run();

    $trip = $testCase->presenter->response()->trip();

    expect($trip)->toBeInstanceOf(Trip::class);
    expect($trip->root()->name())->toBe("Sortie en mer");
    expect($trip->root()->isFree())->toBeFalse();
    expect($trip->root()->skipperId()->value)->toBe(BookBoatForTripSUT::SKIPPER_ID);
});
