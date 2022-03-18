<?php

declare(strict_types=1);

namespace App\BoatBooking\Domain\Enums;

enum TripState: string
{
    case UNCONFIRMED = 'unconfirmed';
    case PLANNED = 'planned';
}
