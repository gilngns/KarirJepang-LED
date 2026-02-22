<x-filament::widget>
    <x-filament::card>

        <div class="meeting-widget">

            <div class="meeting-header">
                <div class="meeting-title">
                    Meeting Hari Ini
                </div>
                <div class="meeting-date">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            @php
                $meetings = $this->getMeetings();
            @endphp

            @if($meetings->isEmpty())
                <div class="meeting-list">
                    Tidak ada meeting hari ini
                </div>
            @else
                <div class="meeting-list">

                    @foreach($meetings as $meeting)
                        <div class="meeting-item">

                            <div class="meeting-info">
                                <div class="meeting-name">
                                    {{ $meeting['title'] }}
                                </div>
                                <div class="meeting-relative">
                                    {{ \Carbon\Carbon::parse($meeting['start'])->diffForHumans() }}
                                </div>
                            </div>

                            <div class="meeting-time">
                                {{ \Carbon\Carbon::parse($meeting['start'])->format('H:i') }}
                            </div>

                        </div>
                    @endforeach

                </div>
            @endif

        </div>

    </x-filament::card>
</x-filament::widget>
