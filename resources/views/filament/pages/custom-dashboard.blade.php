<x-filament-panels::page>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

        {{-- LEFT - TABLE --}}
        <div class="md:col-span-8">
            {{ $this->table }}
        </div>

        {{-- RIGHT - MEETING --}}
        <div class="md:col-span-4">
            <x-filament::card>

                {{-- Header --}}
                <div class="flex justify-between items-start mb-8">
                    <div class="text-lg font-bold">
                        Meeting Hari Ini
                    </div>

                    <div class="text-sm text-gray-400 text-right">
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                @php $meetings = $this->getMeetings(); @endphp

                {{-- Jika Kosong --}}
                @if($meetings->isEmpty())
                    <div class="text-sm text-gray-400">
                        Tidak ada meeting hari ini
                    </div>
                @else

                    <div class="space-y-4">

                        @foreach($meetings as $meeting)
                            @php
                                $start = \Carbon\Carbon::parse($meeting['start']);
                                $end   = \Carbon\Carbon::parse($meeting['end']);
                                $isOngoing = now()->between($start, $end);
                            @endphp

                            <div class="border-b border-gray-700 pb-4 last:border-none last:pb-0">

                                <div class="flex justify-between items-start">

                                    <div>
                                        <div class="font-semibold">
                                            {{ $meeting['title'] }}
                                        </div>

                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ $start->format('H:i') }} - {{ $end->format('H:i') }}
                                        </div>
                                    </div>

                                    @if($isOngoing)
                                        <span class="text-xs bg-green-500/10 text-green-400 px-3 py-1 rounded-full">
                                            Sedang Berlangsung
                                        </span>
                                    @else
                                        <span class="text-xs bg-blue-500/10 text-blue-400 px-3 py-1 rounded-full">
                                            Terjadwal
                                        </span>
                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </x-filament::card>
        </div>

    </div>

</x-filament-panels::page>