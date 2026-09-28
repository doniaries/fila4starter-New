<div class="bg-gray-50 dark:bg-gray-900 min-h-screen pb-12">
    <x-page-header :title="$data->nama_data" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content: Data Details -->
            <div class="lg:w-2/3">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div
                            class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                            <span
                                class="flex items-center gap-1.5 bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 px-3 py-1 rounded-full font-medium">
                                <i class="bi bi-folder2-open"></i> {{ $data->kategoriData->nama ?? 'Umum' }}
                            </span>
                            <span class="flex items-center gap-1.5"><i class="bi bi-calendar3"></i>
                                {{ $data->tahun_terbit ?: '-' }}</span>
                            @if($data->strukturOrganisasi)
                            <span class="flex items-center gap-1.5"><i class="bi bi-diagram-3"></i>
                                {{ $data->strukturOrganisasi->name }}</span>
                            @endif
                            <span class="flex items-center gap-1.5"><i class="bi bi-eye"></i>
                                {{ number_format($data->views) }} dilihat</span>
                            <span class="flex items-center gap-1.5"><i class="bi bi-download"></i>
                                {{ number_format($data->downloads) }} diunduh</span>
                        </div>

                        <div class="prose prose-blue max-w-none dark:prose-invert">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $data->nama_data }}
                            </h2>

                            @if ($data->cover)
                                <img src="{{ asset('storage/' . $data->cover) }}" alt="{{ $data->nama_data }}"
                                    class="w-full h-auto rounded-xl mb-6 shadow-sm">
                            @endif

                            <div class="text-gray-700 dark:text-gray-300 leading-relaxed mb-8">
                                {!! nl2br(e($data->deskripsi)) !!}
                            </div>
                        </div>

                        <!-- Download Section -->
                        <div
                            class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 -mx-6 md:-mx-8 -mb-6 md:-mb-8 p-6 md:p-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Unduh Data</h4>
                            </div>
                            <button wire:click="download" wire:loading.attr="disabled"
                                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-8 py-3 bg-blue-600 hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 active:scale-95 disabled:opacity-75 disabled:cursor-wait text-white font-medium rounded-xl transition-all shadow-md shadow-blue-200 dark:shadow-none min-w-[160px]">

                                <svg wire:loading wire:target="download"
                                    class="animate-spin -ml-1 mr-2 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <i wire:loading.remove wire:target="download"
                                    class="bi bi-cloud-arrow-down text-xl"></i>
                                <span wire:loading.remove wire:target="download">Download File</span>
                                <span wire:loading wire:target="download">Memproses...</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('data.index') }}"
                        class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 font-medium bg-white dark:bg-gray-800 px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm transition-all hover:-translate-x-1">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Data
                    </a>
                </div>
            </div>

            <!-- Sidebar: Related Data -->
            <div class="lg:w-1/3">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="bi bi-list-stars text-blue-500"></i> Data Terbaru Lainnya
                    </h3>

                    <div class="space-y-4">
                        @forelse($relatedData as $item)
                            <a href="{{ route('data.show', $item->slug) }}"
                                class="group block bg-gray-50 dark:bg-gray-900/50 rounded-xl p-4 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-300 border border-transparent hover:border-blue-100 dark:hover:border-blue-800 hover:-translate-y-1 hover:shadow-md">
                                <div class="flex gap-3">
                                    <div class="shrink-0 mt-1">
                                        <div
                                            class="w-10 h-10 bg-white dark:bg-gray-800 rounded-lg shadow-sm flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform">
                                            <i class="bi bi-file-earmark-text text-xl"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4
                                            class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 line-clamp-2 mb-1">
                                            {{ $item->nama_data }}
                                        </h4>
                                        <div class="flex gap-3 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $item->tahun_terbit ?: '-' }}</span>
                                            <span class="flex items-center gap-1"><i class="bi bi-download"></i>
                                                {{ number_format($item->downloads) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                Belum ada data lainnya
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
