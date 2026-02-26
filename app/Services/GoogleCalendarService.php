<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    protected Calendar $service;

    public function __construct()
    {
        $credentialsPath = storage_path('karirjepangmonitoring.json');

        if (!file_exists($credentialsPath)) {
            throw new \Exception("Google credentials file not found at: " . $credentialsPath);
        }

        $client = new Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope(Calendar::CALENDAR_READONLY);

        $this->service = new Calendar($client);
    }

    public function getTodayEvents()
    {
        $calendarId = env('GOOGLE_CALENDAR_ID', 'primary');

        $optParams = [
            'timeMin' => now()->startOfDay()->toRfc3339String(),
            'timeMax' => now()->endOfDay()->toRfc3339String(),
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ];

        try {
            $events = $this->service->events->listEvents($calendarId, $optParams);

            return collect($events->getItems())->map(function ($event) {

                $start = $event->getStart()->getDateTime()
                    ?? $event->getStart()->getDate();

                $end = $event->getEnd()->getDateTime()
                    ?? $event->getEnd()->getDate();

                return [
                    'title' => $event->getSummary(),
                    'start' => $start,
                    'end' => $end,
                ];
            });
        } catch (\Exception $e) {
            Log::error('Google Calendar Error: ' . $e->getMessage());
            return collect();
        }
    }
}
