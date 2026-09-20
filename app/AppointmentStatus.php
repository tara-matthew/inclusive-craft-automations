<?php

namespace App;

enum AppointmentStatus: string
{
    case UPCOMING = 'upcoming';
    case PAST = 'past';
    case ALL = 'all';

    public function label(): string
    {
        return match ($this) {
            self::UPCOMING => 'Upcoming',
            self::PAST => 'Past',
            self::ALL => 'All',
        };
    }
}
