<div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <div class="h-6 w-1 bg-blue-600 rounded-full mr-3"></div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Agenda Kegiatan</h2>
        </div>
        <a wire:navigate href="{{ route('agenda.index') }}"
            class="text-sm text-blue-600 dark:text-blue-400 font-medium hover:underline flex items-center">
            Lihat Semua <i class="bi bi-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-zinc-800 dark:text-gray-300 border-b border-gray-100 dark:border-gray-700">
                <tr>
                    <th scope="col" class="px-4 py-3 rounded-tl-lg">Tanggal</th>
                    <th scope="col" class="px-4 py-3">Kegiatan</th>
                    <th scope="col" class="px-4 py-3 text-center">Status</th>
                    <th scope="col" class="px-4 py-3 text-center">Waktu</th>
                    <th scope="col" class="px-4 py-3 text-center rounded-tr-lg">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($agendas as $agenda)
                    <tr
                        class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-all duration-300 relative group/tr hover:scale-[1.02] hover:shadow-md z-0 hover:z-10">
                        <td class="px-4 py-4 whitespace-nowrap">
                            <a wire:navigate.hover href="{{ route('agenda.show', $agenda->slug) }}"
                                class="before:absolute before:inset-0 z-10"></a>
                            <div
                                class="font-medium text-gray-900 dark:text-white group-hover/tr:text-blue-600 transition-colors">
                                {{ \Carbon\Carbon::parse($agenda->dari_tanggal)->translatedFormat('d M Y') }}
                            </div>
                            @if ($agenda->sampai_tanggal && $agenda->sampai_tanggal != $agenda->dari_tanggal)
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                    s.d. {{ \Carbon\Carbon::parse($agenda->sampai_tanggal)->translatedFormat('d M Y') }}
                                </div>
                            @else
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($agenda->dari_tanggal)->diffForHumans() }}
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-4">
                            <div
                                class="font-medium text-gray-900 dark:text-white line-clamp-2 mb-1 group-hover/tr:text-blue-600 transition-colors">
                                {{ $agenda->nama_agenda }}
                            </div>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <i class="bi bi-geo-alt text-blue-500 mr-1.5"></i>
                                <span class="truncate max-w-[200px]">{{ $agenda->tempat ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-center whitespace-nowrap relative z-20">
                            @php
                                $status = $agenda->status ?? 'Mendatang';
                                $badgeClass = match ($status) {
                                    'Berlangsung'
                                        => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                                    'Selesai' => 'bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-300',
                                    default
                                        => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
                                };
                            @endphp
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td
                            class="px-4 py-4 text-center whitespace-nowrap text-gray-600 dark:text-gray-300 font-medium">
                            {{ $agenda->waktu_mulai ? \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') : '-' }}
                            -
                            {{ $agenda->waktu_selesai ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') : '-' }}
                        </td>
                        <td class="px-4 py-4 text-center whitespace-nowrap">
                            <div
                                class="inline-flex items-center justify-center p-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg group-hover/tr:bg-blue-600 group-hover/tr:text-white transition-all duration-300 relative z-20">
                                <i class="bi bi-eye"></i>
                            </div>
                        </td>
                    </tr>


                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                            <i class="bi bi-calendar-x text-3xl mb-3 block opacity-50"></i>
                            Belum ada agenda kegiatan mendatang
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
