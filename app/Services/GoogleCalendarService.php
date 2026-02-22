<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;

class GoogleCalendarService
{
    protected $service;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(base_path(env('GOOGLE_CALENDAR_CREDENTIALS')));
        $client->addScope(Calendar::CALENDAR_READONLY);

        $this->service = new Calendar($client);
    }

    public function getTodayEvents()
    {
        $calendarId = env('GOOGLE_CALENDAR_ID');

        $optParams = [
            'timeMin' => now()->startOfDay()->toRfc3339String(),
            'timeMax' => now()->endOfDay()->toRfc3339String(),
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ];

        $events = $this->service->events->listEvents($calendarId, $optParams);

        return collect($events->getItems())->map(function ($event) {
            return [
                'title' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime(),
                'end' => $event->getEnd()->getDateTime(),
            ];
        });
    }
}
