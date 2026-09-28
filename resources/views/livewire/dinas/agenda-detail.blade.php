<div>
    <x-page-header :title="$agenda->nama_agenda" />

    <div class="py-8 bg-gray-50 dark:bg-zinc-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <a wire:navigate href="{{ route('agenda.index') }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mb-6 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Agenda
                        </a>

                        <div class="mb-4">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $agenda->nama_agenda }}</h1>
                                    <div class="mt-2">
                                        @php
                                            $status = $agenda->status ?? 'Mendatang';
                                            $badgeClass = match ($status) {
                                                'Berlangsung'
                                                    => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                'Selesai'
                                                    => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                default
                                                    => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                            {{ $status }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-gray-600 dark:text-gray-300">
                                <div class="flex items-center p-3 bg-gray-50 dark:bg-zinc-700 rounded-lg">
                                    <i class="bi bi-calendar-event text-xl text-blue-500 mr-3"></i>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">
                                            Tanggal</p>
                                        <p class="font-medium">
                                            {{ \Carbon\Carbon::parse($agenda->dari_tanggal)->translatedFormat('l, d F Y') }}
                                            @if ($agenda->sampai_tanggal && $agenda->sampai_tanggal != $agenda->dari_tanggal)
                                                s.d.
                                                {{ \Carbon\Carbon::parse($agenda->sampai_tanggal)->translatedFormat('l, d F Y') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if ($agenda->waktu_mulai)
                                    <div class="flex items-center p-3 bg-gray-50 dark:bg-zinc-700 rounded-lg">
                                        <i class="bi bi-clock text-xl text-blue-500 mr-3"></i>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">
                                                Waktu</p>
                                            <p class="font-medium">
                                                {{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') }}
                                                @if ($agenda->waktu_selesai)
                                                    - {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                                                    WIB
                                                @else
                                                    WIB
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($agenda->tempat)
                                    <div
                                        class="flex items-center p-3 bg-gray-50 dark:bg-zinc-700 rounded-lg md:col-span-2">
                                        <i class="bi bi-geo-alt text-xl text-blue-500 mr-3"></i>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">
                                                Lokasi</p>
                                            <p class="font-medium">{{ $agenda->tempat }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-center p-3 bg-gray-50 dark:bg-zinc-700 rounded-lg md:col-span-2">
                                    <i class="bi bi-building text-xl text-blue-500 mr-3"></i>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">
                                            Penyelenggara</p>
                                        <p class="font-medium">{{ $agenda->penyelenggara }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Deskripsi Kegiatan
                                </h5>
                                <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                    {!! $agenda->uraian_agenda !!}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
