<?php

namespace App\Traits;

use App\Models\EventSchedule;

trait ResolvesEventSchedule
{
    protected function resolveSchedule($eventId, $programmeId, $date, $section, $batch, $semester)
    {
        return EventSchedule::where('event_id', $eventId)
            ->where('programme_id', $programmeId)
            ->where('section', $section)
            ->where('batch', $batch)
            ->where('semester', $semester)
            ->whereDate('event_date', $date)
            ->first();
    }
}
