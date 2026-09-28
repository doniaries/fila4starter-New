<section id="gallery" class="py-16 bg-white dark:bg-zinc-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                <span class="bg-clip-text text-transparent bg-linear-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
                    Galeri Kegiatan
                </span>
            </h2>
            <div class="mt-2 h-1 w-20 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        @if(isset($galleries) && $galleries->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 auto-rows-[180px] md:auto-rows-[220px]">
            @foreach($galleries as $index => $gallery)
                @php
                    // 1 Besar (index 0), 4 Kecil (index 1-4)
                    $colSpan = ($index == 0) 
                        ? 'col-span-2 row-span-2 md:col-span-2 md:row-span-2 lg:col-span-2 lg:row-span-2' 
                        : 'col-span-1 row-span-1';
                    $image = is_array($gallery->images) && count($gallery->images) > 0 ? $gallery->images[0] : null;
                @endphp
                
                @if($image)
                <a wire:navigate href="{{ route('galeri.show', $gallery->slug) }}" 
                   class="relative group rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 {{ $colSpan }}">
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image) }}" alt="{{ $gallery->title }}" 
                         class="w-full h-full object-cover transition-transform duration-1000 transform group-hover:scale-110" loading="lazy"
                         onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Image+Not+Found'">
                    
                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/30 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300"></div>
                    
                    {{-- Content Overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 p-5 translate-y-2 group-hover:translate-y-0 transition-transform duration-300 ease-out">
                        <h3 class="text-white font-bold {{ $index == 0 ? 'text-xl md:text-2xl' : 'text-sm md:text-base' }} leading-tight mb-2 drop-shadow-md line-clamp-2">
                            {{ $gallery->title }}
                        </h3>
                        <p class="text-gray-300 text-xs flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                            <i class="bi bi-calendar-event mr-2"></i> 
                            {{ $gallery->created_at->format('d M Y') }}
                        </p>
                    </div>

                    {{-- Hover Icon --}}
                    <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-[-10px] group-hover:translate-y-0">
                         <div class="bg-white/20 backdrop-blur-md p-2.5 rounded-xl border border-white/30 text-white shadow-xl">
                            <i class="bi bi-arrow-up-right text-xl"></i>
                         </div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
        
        <div class="mt-10 text-center">
            <a wire:navigate href="{{ route('galeri.index') }}" class="group inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-blue-600/30">
                Lihat Galeri Lainnya
                <i class="bi bi-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        @else
            <div class="flex flex-col items-center justify-center py-12 text-gray-500 dark:text-gray-400">
                <i class="bi bi-images text-5xl mb-4"></i>
                <p>Belum ada galeri yang diupload.</p>
            </div>
        @endif
    </div>
</section>
