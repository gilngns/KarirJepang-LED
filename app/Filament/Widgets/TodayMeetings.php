<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Services\GoogleCalendarService;

class TodayMeetings extends Widget
{
    protected string $view = 'filament.widgets.today-meetings';

    protected int|string|array $columnSpan = 'full';

    public function getMeetings()
    {
        return app(GoogleCalendarService::class)->getTodayEvents();
    }
}
