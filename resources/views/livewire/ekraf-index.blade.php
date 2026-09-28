<div class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen relative">
    <div>
        <x-page-header title="Ekonomi Kreatif" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="mb-6 flex items-center justify-between">
                        <p class="text-gray-600 dark:text-gray-400">{{ $pelaku->total() }} pelaku ekraf ditemukan</p>

                        {{-- Active Filter --}}
                        @if ($bidang)
                            <div class="mb-8">
                                <div class="animate-fade-in-up">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-md text-sm bg-blue-50 text-blue-700 border border-blue-100">
                                        Bidang: <strong>{{ Str::title(str_replace('-', ' ', $bidang)) }}</strong>
                                        <a wire:navigate href="{{ route('ekraf.index') }}" class="ml-1 text-blue-400 hover:text-red-500 transition-colors" title="Hapus Filter">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Pelaku Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($pelaku as $item)
                            <a wire:navigate href="{{ route('ekraf.show', $item->slug) }}" class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                                <!-- Image Section -->
                                <div class="relative h-48 overflow-hidden bg-gray-100 dark:bg-gray-700">
                                    @if ($item->gambar)
                                        <img src="{{ str_starts_with($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_pelaku }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700">
                                            <i class="bi bi-image text-4xl text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                    @endif
                                    
                                    @if($item->kategoriEkraf)
                                        <div class="absolute top-4 left-4 z-10">
                                            <span class="px-3 py-1 bg-blue-600/90 backdrop-blur-sm text-white text-xs font-semibold rounded-full shadow-lg">
                                                {{ $item->kategoriEkraf->nama }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                                        {{ $item->nama_pelaku }}
                                    </h3>
                                    
                                    @if($item->kategori_usaha)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-2">
                                            <i class="bi bi-tag-fill text-blue-500"></i>
                                            {{ $item->kategori_usaha }}
                                        </p>
                                    @endif
                                    
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-4 flex-1">
                                        {{ strip_tags($item->deskripsi) }}
                                    </p>
                                    
                                    <div class="mt-auto flex items-center justify-between border-t border-gray-100 dark:border-gray-700 pt-4">
                                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <i class="bi bi-geo-alt-fill text-red-500 mr-1.5"></i>
                                            <span class="truncate max-w-[120px]">{{ $item->kecamatan ?? 'Sijunjung' }}</span>
                                        </div>
                                        <span class="text-blue-600 dark:text-blue-400 text-sm font-semibold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                            Detail <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <i class="bi bi-inboxes text-6xl text-gray-400 dark:text-gray-500 mb-4 inline-block"></i>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ada pelaku ekraf yang ditemukan.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($pelaku->hasPages())
                        <div class="mt-8">
                            {{ $pelaku->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 border-l border-gray-100 dark:border-gray-700 pl-0 lg:pl-8">
                    <div class="sticky top-24">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-colors duration-200">
                            <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4 flex items-center">
                                <span class="w-1 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Bidang Ekraf
                            </h3>

                            <div class="flex flex-col gap-2">
                                @forelse($bidangList as $b)
                                    @php
                                        $isActive = request()->query('bidang') === $b->slug;
                                    @endphp
                                    <a wire:navigate href="{{ route('ekraf.index', ['bidang' => $b->slug]) }}"
                                        class="flex items-center justify-between px-3 py-2 rounded-lg transition-all duration-200 {{ $isActive ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                        <span>{{ $b->nama }}</span>
                                        <span class="text-xs px-2 py-0.5 rounded-full {{ $isActive ? 'bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-300' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}">
                                            {{ $b->pelaku_ekrafs_count }}
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-500 dark:text-gray-400 italic px-2">Belum ada bidang ekraf.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
