<div
    class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full flex flex-col">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <div class="h-6 w-1 bg-yellow-400 rounded-full mr-3"></div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pengumuman</h2>
        </div>
        <a wire:navigate href="{{ route('pengumuman.index') }}"
            class="text-sm text-blue-600 dark:text-blue-400 font-medium hover:underline flex items-center">
            Lihat Semua <i class="bi bi-arrow-right ml-1"></i>
        </a>
    </div>

    <div class="flex-1 space-y-4">
        @forelse($pengumuman as $item)
            <div
                class="group relative bg-yellow-50 dark:bg-yellow-900/10 rounded-lg p-4 border border-yellow-100 dark:border-yellow-900/30 hover:shadow-xl hover:scale-[1.02] hover:border-yellow-400/50 hover:bg-yellow-100/50 dark:hover:bg-yellow-900/20 transition-all duration-300 cursor-pointer">
                <a wire:navigate.hover href="{{ route('pengumuman.show', $item->slug) }}"
                    class="before:absolute before:inset-0 z-10"></a>

                <div class="flex items-start">
                    <div class="shrink-0">
                        <div
                            class="h-10 w-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:scale-110 transition-transform duration-300">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                <i class="bi bi-clock mr-1"></i> {{ $item->published_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <h3
                                class="font-bold text-gray-900 dark:text-white leading-tight line-clamp-1 md:line-clamp-2 flex-1 relative z-10">
                                <a wire:navigate href="{{ route('pengumuman.show', $item->slug) }}"
                                    class="hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors block w-full">
                                    {{ $item->judul }}
                                </a>
                            </h3>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-2 mb-3">
                            {{ Str::limit(strip_tags($item->isi), 80) }}
                        </p>
                        <a wire:navigate href="{{ route('pengumuman.show', $item->slug) }}"
                            class="text-xs font-semibold text-yellow-600 dark:text-yellow-400 group-hover:translate-x-1 transition-all inline-flex items-center before:absolute before:inset-0">
                            Baca Selengkapnya <i class="bi bi-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div
                class="text-center py-10 px-4 bg-gray-50 dark:bg-zinc-800/50 rounded-lg border border-dashed border-gray-200 dark:border-gray-700">
                <div
                    class="h-16 w-16 bg-gray-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="bi bi-bell-slash text-2xl text-gray-400"></i>
                </div>
                <h4 class="text-gray-900 dark:text-white font-medium mb-1">Belum Ada Pengumuman</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada pengumuman yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
