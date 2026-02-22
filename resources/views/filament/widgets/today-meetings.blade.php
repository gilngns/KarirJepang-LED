<x-filament::widget>
    <x-filament::card>

        <div class="flex justify-between items-center mb-4">
            <div class="text-lg font-bold">
                Meeting Hari Ini
            </div>
            <div class="text-sm text-gray-400">
                {{ now()->translatedFormat('d F Y') }}
            </div>
        </div>

        @php $meetings = $this->getMeetings(); @endphp

        @if($meetings->isEmpty())
            <div class="text-sm text-gray-400">
                Tidak ada meeting hari ini
            </div>
        @else
            @foreach($meetings as $meeting)
                <div class="flex justify-between items-center border-b py-2">

                    <div>
                        <div class="font-semibold">
                            {{ $meeting['title'] }}
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($meeting['start'])->diffForHumans() }}
                        </div>
                    </div>

                    <div class="text-blue-400 font-bold">
                        {{ \Carbon\Carbon::parse($meeting['start'])->format('H:i') }}
                    </div>

                </div>
            @endforeach
        @endif

    </x-filament::card>
</x-filament::widget>