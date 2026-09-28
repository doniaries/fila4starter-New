<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <x-page-header title="Data Dinas" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search and Filter -->
        <div
            class="mb-8 flex flex-col md:flex-row gap-4 items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="w-full md:w-96 relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari data..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $data_list->count() }} dari {{ $data_list->total() }} data
            </div>
        </div>

        <!-- Document List -->
        <div class="space-y-4">
            @forelse($data_list as $data_item)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-700 group">
                    <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                        <!-- Icon/Cover -->
                        <div class="shrink-0">
                            @if ($data_item->cover)
                                <img src="{{ asset('storage/' . $data_item->cover) }}" alt="{{ $data_item->nama_data }}"
                                    class="w-16 h-20 object-cover rounded-lg shadow-sm group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div
                                    class="w-16 h-20 bg-blue-50 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-500 dark:text-blue-400">
                                    <i class="bi bi-file-earmark-text text-3xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="grow min-w-0">
                            <a href="{{ route('data.show', $data_item->slug) }}" class="block">
                                <h3
                                    class="text-lg font-semibold text-gray-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ $data_item->nama_data }}
                                </h3>
                                <span class="text-xs font-medium text-blue-600 dark:text-blue-400 mb-2 inline-block">
                                    {{ $data_item->kategoriData->nama ?? 'Umum' }}
                                    @if($data_item->strukturOrganisasi)
                                        <span class="text-gray-400 dark:text-gray-500 mx-1">|</span>
                                        {{ $data_item->strukturOrganisasi->name }}
                                    @endif
                                </span>
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                {{ $data_item->deskripsi }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                <span class="flex items-center gap-1.5 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $data_item->tahun_terbit ?: '-' }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="bi bi-download"></i>
                                    {{ number_format($data_item->downloads) }} kali diunduh
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="bi bi-eye"></i>
                                    {{ number_format($data_item->views) }} kali dilihat
                                </span>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="shrink-0 mt-4 md:mt-0 w-full md:w-auto">
                            <button wire:click="download({{ $data_item->id }})" wire:loading.attr="disabled"
                                wire:target="download({{ $data_item->id }})"
                                class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 hover:-translate-y-0.5 hover:shadow-md active:scale-95 disabled:opacity-75 disabled:cursor-wait text-white text-sm font-medium rounded-lg transition-all shadow-sm shadow-blue-200 dark:shadow-none min-w-[140px]">

                                <!-- Loading Spinner -->
                                <svg wire:loading wire:target="download({{ $data_item->id }})"
                                    class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>

                                <!-- Default Icon -->
                                <i wire:loading.remove wire:target="download({{ $data_item->id }})"
                                    class="bi bi-cloud-arrow-down text-lg"></i>

                                <!-- Text -->
                                <span wire:loading.remove wire:target="download({{ $data_item->id }})">Download</span>
                                <span wire:loading wire:target="download({{ $data_item->id }})">Proses...</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <i class="bi bi-folder2-open text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Tidak ada data ditemukan</h3>
                    <p class="text-gray-500 dark:text-gray-400">Cobalah kata kunci pencarian yang lain.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $data_list->links() }}
        </div>
    </div>
</div>
