<x-filament-panels::page>

    {{-- ======================= --}}
    {{-- ROW 1: ABSEN + MEETING --}}
    {{-- ======================= --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

        {{-- LEFT - TABLE --}}
        <div class="md:col-span-8">
            {{ $this->table }}
        </div>

        {{-- RIGHT - MEETING --}}
        <div class="md:col-span-4">
            <x-filament::card>

                <div class="flex justify-between items-start mb-8">
                    <div class="text-lg font-bold">
                        Meeting Hari Ini
                    </div>

                    <div class="text-sm text-gray-400 text-right">
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                @php $meetings = $this->getMeetings(); @endphp

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


    {{-- ======================= --}}
{{-- ROW 2: PROGRESS DIVISI --}}
{{-- ======================= --}}
<div class="grid grid-cols-1 md:grid-cols-12 gap-8 mt-4">

    <div class="md:col-span-8">
        <x-filament::card>

            <div class="text-lg font-bold mb-6">
                Laporan Progress Divisi
            </div>

            @php $reports = $this->getLatestDivisionReports(); @endphp

            <div class="space-y-3">

                <div class="flex justify-between text-xs font-semibold text-gray-400 border-b border-gray-700 pb-2">
                    <div class="w-1/4">NAMA DIVISI</div>
                    <div class="w-2/4">JOB DESCRIPTION</div>
                    <div class="w-1/4 text-right">PROGRESS %</div>
                </div>

                @foreach($reports as $report)

                    <div class="flex justify-between items-center bg-gray-800 rounded-lg px-4 py-5 text-sm">

                        <div class="w-1/4 font-semibold text-blue-400">
                            {{ $report->division->name }}
                        </div>

                        <div class="w-2/4 text-gray-300 truncate px-4">
                            {{ $report->job_description }}
                        </div>

                        <div class="w-1/4 text-right font-bold
                            {{ $report->progress_percentage == 100 ? 'text-green-400' :
                               ($report->progress_percentage >= 75 ? 'text-blue-400' :
                               ($report->progress_percentage >= 50 ? 'text-yellow-400' :
                               'text-red-400')) }}">
                            {{ $report->progress_percentage }}%
                        </div>

                    </div>

                @endforeach

            </div>

        </x-filament::card>
    </div>

</div>

{{-- ======================= --}}
{{-- ROW 3: CHART PMI --}}
{{-- ======================= --}}
<div class="grid grid-cols-1 md:grid-cols-12 gap-8 mt-8">

    <div class="md:col-span-8">
        <x-filament::card>

            <div class="text-xl font-bold mb-6 text-center tracking-wide">
                JUMLAH KEBERANGKATAN PMI
            </div>

           @php
                $chart = $this->getPmiYearlyVisaChart();

                $colors = ['#ef4444', '#1f2937', '#3b82f6', '#22c55e'];

                $formattedDatasets = collect($chart['datasets'])->map(function ($dataset, $index) use ($colors) {
                    return [
                        'label' => $dataset['label'],
                        'data' => $dataset['data'],
                        'backgroundColor' => $colors[$index % count($colors)],
                        'borderRadius' => 6,
                    ];
                })->values();
            @endphp

            <canvas id="pmiChart"></canvas>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
            document.addEventListener('DOMContentLoaded', function () {

                const ctx = document.getElementById('pmiChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($chart['labels']),
                        datasets: @json($formattedDatasets),
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: '#9ca3af'
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: '#9ca3af'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#9ca3af'
                                }
                            }
                        }
                    }
                });

            });
            </script>

        </x-filament::card>
    </div>

</div>

{{-- ======================= --}}
{{-- ROW 4: MITRA KARIR --}}
{{-- ======================= --}}
<div class="grid grid-cols-1 md:grid-cols-12 gap-8 mt-8">

    <div class="md:col-span-8">
        <x-filament::card>

            <div class="text-xl font-bold text-center mb-10 tracking-wide">
                DAFTAR MITRA KARIR JEPANG
            </div>

            @php $partners = $this->getPartners(); @endphp

            <div class="grid grid-cols-2 md:grid-cols-4 gap-10">

                @foreach($partners as $partner)

                    <div class="text-center">

                        <a href="{{ $partner->website ?? '#' }}"
                           target="_blank"
                           class="group block">

                            {{-- Circle Wrapper (lebih kecil & proporsional) --}}
                            <div class="w-24 h-24 mx-auto 
                                        rounded-full 
                                        bg-gray-800 
                                        border border-gray-700
                                        flex items-center justify-center
                                        overflow-hidden
                                        transition
                                        group-hover:border-blue-500
                                        group-hover:shadow-lg">

                                <img src="{{ asset('storage/' . $partner->logo) }}"
                                     alt="{{ $partner->name }}"
                                     class="max-w-[60%] max-h-[60%] object-contain transition group-hover:scale-105">

                            </div>

                            <div class="mt-4 text-sm font-semibold text-blue-400 group-hover:text-blue-300 transition">
                                {{ $partner->name }}
                            </div>

                        </a>

                    </div>

                @endforeach

            </div>

        </x-filament::card>
    </div>

</div>

</x-filament-panels::page>