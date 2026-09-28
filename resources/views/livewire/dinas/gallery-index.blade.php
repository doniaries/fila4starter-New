<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <x-page-header title="Galeri Kegiatan" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleries as $gallery)
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group">
                <!-- Image Slider / Thumbnail -->
                <a wire:navigate href="{{ route('galeri.show', $gallery->slug) }}" class="block relative aspect-video overflow-hidden bg-gray-100 dark:bg-gray-700">
                    @if($gallery->thumbnail_url)
                    <img src="{{ $gallery->thumbnail_url }}" alt="{{ $gallery->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy"
                        onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Image+Not+Found'">

                    @if(count($gallery->images) > 1)
                    <div class="absolute bottom-2 right-2 px-2 py-1 bg-black/60 text-white text-xs rounded-md">
                        <i class="bi bi-images mr-1"></i> {{ count($gallery->images) }} Foto
                    </div>
                    @endif
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="bi bi-image text-4xl"></i>
                    </div>
                    @endif
                </a>

                <!-- Content -->
                <div class="p-6">
                    <div class="text-xs text-blue-600 dark:text-blue-400 font-medium mb-2">
                        {{ $gallery->published_at ? $gallery->published_at->format('d F Y') : '-' }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 transition-colors">
                        <a wire:navigate href="{{ route('galeri.show', $gallery->slug) }}" class="group-hover:text-blue-600 dark:group-hover:text-blue-400">
                            {{ $gallery->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4">
                        {{ $gallery->description }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <i class="bi bi-images text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Belum ada galeri kegiatan</h3>
                <p class="text-gray-500 dark:text-gray-400">Saat ini belum ada dokumentasi kegiatan yang diunggah.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </div>
</div>