<div class="bg-gray-50 dark:bg-zinc-900 min-h-screen">
    @push('title', $pageTitle)
    @push('meta')
        <meta name="description" content="{{ $pageDescription }}">
    @endpush

    @push('styles')
        <style>
            @keyframes progress-linear {
                0% { width: 0%; }
                100% { width: 100%; }
            }
            .animate-progress {
                animation: progress-linear 3s linear infinite;
            }
        </style>
    @endpush

    <x-page-header :title="$gallery->title" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div
            class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 md:p-8">
                {{-- Meta Info --}}
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-6">
                    <span class="flex items-center">
                        <i class="bi bi-calendar3 mr-2"></i>
                        {{ $gallery->published_at ? $gallery->published_at->format('d F Y') : '-' }}
                    </span>
                    @if (count($gallery->images) > 0)
                        <span class="mx-3">•</span>
                        <span class="flex items-center">
                            <i class="bi bi-images mr-2"></i>
                            {{ count($gallery->images) }} Foto
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                @if ($gallery->description)
                    <div class="prose dark:prose-invert max-w-none mb-8 text-gray-700 dark:text-gray-300">
                        <p>{{ $gallery->description }}</p>
                    </div>
                @endif

                {{-- Image Grid --}}
                @if ($gallery->image_urls && count($gallery->image_urls) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="gallery-grid">
                        @foreach ($gallery->image_urls as $index => $imageUrl)
                            <div class="group relative aspect-square overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-700 cursor-pointer"
                                x-data="{}"
                                x-on:click="$dispatch('open-lightbox', { index: {{ $index }} })">
                                <img src="{{ $imageUrl }}" alt="{{ $gallery->title }} - Image {{ $index + 1 }}"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='https://placehold.co/400x400/e2e8f0/64748b?text=Image+Not+Found'"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                <div
                                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                    <i
                                        class="bi bi-zoom-in text-white opacity-0 group-hover:opacity-100 text-3xl transition-opacity duration-300 transform scale-50 group-hover:scale-100"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 dark:bg-zinc-700/30 rounded-lg">
                        <i class="bi bi-images text-4xl text-gray-400 mb-3 block"></i>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada foto dalam galeri ini.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Back Button --}}
        <div class="mt-8 text-center">
            <a wire:navigate href="{{ route('galeri.index') }}"
                class="inline-flex items-center font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                <i class="bi bi-arrow-left mr-2"></i> Kembali ke Galeri
            </a>
        </div>
    </div>

    {{-- Lightbox Component (Alpine.js) --}}
    <div x-data="{
        isOpen: false,
        currentIndex: 0,
        isPlaying: false,
        autoplayInterval: null,
        images: @js($gallery->image_urls),
        
        init() {
            this.$watch('isOpen', value => {
                if (value) {
                    document.body.classList.add('overflow-hidden');
                } else {
                    document.body.classList.remove('overflow-hidden');
                    this.stopAutoplay();
                }
            });
        },
        
        next() {
            this.currentIndex = (this.currentIndex === this.images.length - 1) ? 0 : this.currentIndex + 1;
        },
        
        prev() {
            this.currentIndex = (this.currentIndex === 0) ? this.images.length - 1 : this.currentIndex - 1;
        },
        
        toggleAutoplay() {
            if (this.isPlaying) {
                this.stopAutoplay();
            } else {
                this.startAutoplay();
            }
        },
        
        startAutoplay() {
            this.isPlaying = true;
            this.autoplayInterval = setInterval(() => {
                this.next();
            }, 3000);
        },
        
        stopAutoplay() {
            this.isPlaying = false;
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
                this.autoplayInterval = null;
            }
        }
    }" 
        @open-lightbox.window="isOpen = true; currentIndex = $event.detail.index; stopAutoplay();"
        @keydown.escape.window="isOpen = false" 
        @keydown.left.window="prev()"
        @keydown.right.window="next()"
        @click.self="isOpen = false" 
        x-show="isOpen" 
        style="display: none;"
        class="fixed inset-0 z-100 flex items-center justify-center bg-black/95 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300" 
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" 
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0">

        {{-- Top Controls --}}
        <div class="absolute top-0 left-0 right-0 p-4 flex justify-between items-center z-50">
            <div class="text-white bg-black/40 px-3 py-1.5 rounded-full text-sm font-medium backdrop-blur-md border border-white/10">
                <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
            </div>
            
            <div class="flex items-center gap-3">
                {{-- Play/Pause Button --}}
                <button @click="toggleAutoplay()" 
                        class="text-white/80 hover:text-white p-2 transition-colors bg-white/10 hover:bg-white/20 rounded-full"
                        :title="isPlaying ? 'Pause' : 'Play Auto-play'">
                    <i class="bi" :class="isPlaying ? 'bi-pause-fill' : 'bi-play-fill'" style="font-size: 1.5rem;"></i>
                </button>
                
                {{-- Close Button --}}
                <button @click="isOpen = false" 
                        class="text-white/80 hover:text-white p-2 transition-colors bg-white/10 hover:bg-white/20 rounded-full">
                    <i class="bi bi-x-lg" style="font-size: 1.5rem;"></i>
                </button>
            </div>
        </div>

        {{-- Previous Button --}}
        <button @click.stop="prev(); stopAutoplay();"
            class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-white/80 z-50 p-3 md:p-4 focus:outline-none transition-all bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm group"
            x-show="images.length > 1">
            <i class="bi bi-chevron-left text-2xl md:text-4xl group-hover:-translate-x-1 transition-transform"></i>
        </button>

        {{-- Next Button --}}
        <button @click.stop="next(); stopAutoplay();"
            class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-white/80 z-50 p-3 md:p-4 focus:outline-none transition-all bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm group"
            x-show="images.length > 1">
            <i class="bi bi-chevron-right text-2xl md:text-4xl group-hover:translate-x-1 transition-transform"></i>
        </button>

        {{-- Image Container --}}
        <div class="relative w-full h-full flex flex-col items-center justify-center p-4" @click.self="isOpen = false">
            <div class="relative group max-w-full max-h-[85vh]">
                <img :src="images[currentIndex]" 
                     :key="currentIndex"
                     class="max-w-full max-h-[85vh] object-contain shadow-2xl rounded-sm"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100">
                
                {{-- Progress Bar (Only during auto-play) --}}
                <div x-show="isPlaying" 
                     class="absolute bottom-0 left-0 h-1 bg-blue-500 rounded-full animate-progress"
                     style="box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);"></div>
            </div>
            
            {{-- Title/Caption if needed (optional) --}}
            <div class="mt-4 text-center text-white/90 text-lg font-medium max-w-2xl px-4 drop-shadow-md">
                {{ $gallery->title }}
            </div>
        </div>
    </div>
</div>
