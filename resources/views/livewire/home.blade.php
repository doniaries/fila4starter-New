<div class="space-y-12">
    @push('title', $pageTitle)
    @push('meta')
        <meta name="description" content="{{ $pageDescription }}">
    @endpush

    {{-- Slider Section with Popular Posts Overlay --}}
    <livewire:slider />

    {{-- Berita Section --}}
    <section id="berita-informasi" class="bg-white dark:bg-zinc-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                {{-- Berita Terbaru Column --}}
                <div class="lg:col-span-4">
                    {{-- Kategori Section --}}
                    @if (isset($categories) && $categories->count() > 0)
                        <div class="mb-10">
                            <div class="flex items-center mb-5">
                                <i class="bi bi-tags-fill text-blue-600 text-xl mr-3"></i>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Kategori Berita</h2>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                @foreach ($categories as $category)
                                    @php
                                        // Strictly vibrant 17-color fallback palette (No grays/slates)
                                        $fallbackColors = [
                                            '#ef4444',
                                            '#f97316',
                                            '#f59e0b',
                                            '#eab308',
                                            '#84cc16',
                                            '#22c55e',
                                            '#10b981',
                                            '#14b8a6',
                                            '#06b6d4',
                                            '#0ea5e9',
                                            '#3b82f6',
                                            '#6366f1',
                                            '#8b5cf6',
                                            '#a855f7',
                                            '#d946ef',
                                            '#ec4899',
                                            '#f43f5e',
                                        ];

                                        $baseColor = $category->color;
                                        if (empty($baseColor)) {
                                            $colorIndex = $category->id % count($fallbackColors);
                                            $baseColor = $fallbackColors[$colorIndex];
                                        }

                                        // Auto adjust text color based on background brightness
                                        $hex = str_replace('#', '', $baseColor);
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));
                                        $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
                                        $textColor = $brightness > 160 ? 'text-gray-900' : 'text-white';

                                        // Badge background variants
                                        $bgColor = $baseColor;
                                    @endphp

                                    <a wire:navigate href="{{ route('berita.index', ['category' => $category->slug]) }}"
                                        class="group relative flex items-center px-4 py-2 rounded-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden shadow-sm hover:shadow-md border border-black/5"
                                        style="background-color: {{ $bgColor }};">

                                        <!-- Content -->
                                        <div
                                            class="relative z-10 flex items-center justify-between w-full gap-3 {{ $textColor }} transition-transform duration-300 group-hover:scale-105">
                                            <span class="font-bold text-sm tracking-wide">
                                                {{ $category->name }}
                                            </span>
                                            <span
                                                class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-bold backdrop-blur-xs">
                                                {{ $category->posts_count }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach

                                @if (\App\Models\Tag::count() > 8)
                                    <a wire:navigate href="{{ route('kategori.index') }}"
                                        class="group relative flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 border border-blue-600 rounded-xl hover:shadow-md transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                                        <div
                                            class="relative z-10 flex items-center justify-center w-full gap-2 transition-colors duration-300">
                                            <span class="font-semibold text-sm text-white">
                                                Lihat Semua Kategori
                                            </span>
                                            <i class="bi bi-arrow-right text-white"></i>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center mb-6">
                        <div class="h-8 w-1 bg-red-600 rounded-full mr-3"></div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Berita Terkini</h2>
                    </div>

                    <div class="min-h-[300px]">
                        <livewire:home-latest-posts />
                    </div>

                    <div class="mt-8 text-center">
                        <a wire:navigate href="{{ route('berita.index') }}"
                            class="inline-flex items-center px-6 py-2.5 border border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 font-medium rounded-full hover:bg-blue-600 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white transition-all duration-300">
                            Lihat Semua Berita <i class="bi bi-arrow-right-short ml-2 text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Infografis Section --}}
    <section id="infografis" class="relative py-20 overflow-hidden bg-gray-900 border-t border-gray-800">
        @if ($infografis->count() > 0)
            {{-- Blurred Background --}}
            <div class="absolute inset-0 z-0 opacity-40 select-none pointer-events-none" aria-hidden="true">
                <div class="absolute inset-0 bg-linear-to-t from-gray-900 via-transparent to-gray-900 z-10"></div>
                <div x-data="{ activeImage: '{{ $infografis[0]->image_url }}' }" 
                     @infografis-change.window="activeImage = $event.detail.image" class="w-full h-full">
                    <img :src="activeImage" :key="activeImage"
                        class="w-full h-full object-cover filter blur-3xl transition-all duration-1000 scale-110">
                </div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" 
                 x-data="{ 
                    modalOpen: false, 
                    previewImage: '',
                    openModal(img) {
                        this.previewImage = img;
                        this.modalOpen = true;
                    }
                 }">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">
                        Infografis <span class="text-blue-500">Terkini</span>
                    </h2>
                    <div class="mt-2 h-1 w-20 bg-blue-600 mx-auto rounded-full"></div>
                </div>

                <!-- Swiper Container -->
                <div class="swiper infografis-swiper pb-14! translate-y-4">
                    <div class="swiper-wrapper">
                        @foreach ($infografis as $item)
                            <div class="swiper-slide w-[280px]! md:w-[450px]! aspect-3/4 md:aspect-auto">
                                <div class="group relative h-full w-full rounded-2xl overflow-hidden shadow-2xl border border-white/10 bg-gray-800 cursor-pointer"
                                     @click="openModal('{{ $item->image_url }}')">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->judul }}"
                                         class="w-full h-full object-contain md:object-cover transition-transform duration-500 group-hover:scale-105">
                                    
                                    <div class="absolute inset-x-0 bottom-0 p-6 bg-linear-to-t from-black/90 via-black/40 to-transparent translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                        <h3 class="text-white font-bold text-lg leading-tight">{{ $item->judul }}</h3>
                                    </div>

                                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity bg-blue-600/80 backdrop-blur-sm p-2 rounded-lg text-white">
                                        <i class="bi bi-zoom-in text-xl"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination & Navigation Combined -->
                    <div class="flex items-center justify-center mt-12 gap-8">
                        <button class="infografis-prev w-12 h-12 rounded-full bg-white/10 hover:bg-blue-600 text-white flex items-center justify-center transition-all duration-300 border border-white/10 hover:border-blue-500 shadow-xl backdrop-blur-sm group">
                            <i class="bi bi-chevron-left text-xl group-hover:-translate-x-1 transition-transform"></i>
                        </button>
                        
                        <div class="swiper-pagination static! w-auto! text-white font-mono text-xl font-bold tracking-widest min-w-[60px]"></div>
                        
                        <button class="infografis-next w-12 h-12 rounded-full bg-white/10 hover:bg-blue-600 text-white flex items-center justify-center transition-all duration-300 border border-white/10 hover:border-blue-500 shadow-xl backdrop-blur-sm group">
                            <i class="bi bi-chevron-right text-xl group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>

                <!-- Preview Modal (Teleported to Body) -->
                <template x-teleport="body">
                        <div x-show="modalOpen" style="display: none;"
                            class="fixed inset-0 z-99999 flex items-center justify-center bg-black/95 backdrop-blur-xl p-4"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        @keydown.escape.window="modalOpen = false" @click="modalOpen = false">

                        <button @click="modalOpen = false" class="absolute top-6 right-6 text-white/70 hover:text-white z-50 p-2 bg-white/10 rounded-full backdrop-blur-md transition-colors">
                            <i class="bi bi-x-lg text-2xl"></i>
                        </button>

                        <div class="relative w-full h-full flex flex-col items-center justify-center p-4 cursor-pointer"
                            @click.self="modalOpen = false">
                            <div class="relative flex-1 w-full flex items-center justify-center overflow-hidden"
                                x-data="{
                                    zoom: 1,
                                    panX: 0,
                                    panY: 0,
                                    isDragging: false,
                                    startX: 0,
                                    startY: 0
                                }"
                                @mousedown.prevent="if(zoom > 1) { isDragging = true; startX = $event.clientX - panX; startY = $event.clientY - panY; }"
                                @mousemove.window="if(isDragging) { panX = $event.clientX - startX; panY = $event.clientY - startY; }"
                                @mouseup.window="isDragging = false">

                                <img :src="previewImage"
                                    class="max-w-full max-h-[90vh] w-auto h-auto object-contain shadow-2xl rounded-lg transition-transform duration-200"
                                    :class="{
                                        'cursor-grab': zoom > 1 && !isDragging,
                                        'cursor-grabbing': isDragging,
                                        'cursor-zoom-in': zoom === 1
                                    }"
                                    :style="`transform: scale(${zoom}) translate(${panX}px, ${panY}px); transition: ${isDragging ? 'none' : 'transform 0.2s ease-out'}`"
                                    @click.stop="if(zoom === 1) { zoom = 2 } else { zoom = 1; panX = 0; panY = 0 }">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            @push('scripts')
            <script>
                function initInfografisSwiper() {
                    const swiperEl = document.querySelector('.infografis-swiper');
                    if (swiperEl && typeof Swiper !== 'undefined') {
                        // Destroy existing swiper if any to prevent duplicates
                        if (swiperEl.swiper) {
                            swiperEl.swiper.destroy();
                        }
                        
                        new Swiper('.infografis-swiper', {
                            effect: 'coverflow',
                            grabCursor: true,
                            centeredSlides: true,
                            slidesPerView: 'auto',
                            loop: {{ $infografis->count() > 3 ? 'true' : 'false' }},
                            coverflowEffect: {
                                rotate: 10,
                                stretch: 0,
                                depth: 200,
                                modifier: 1.5,
                                slideShadows: true,
                            },
                            autoplay: {
                                delay: 3000, 
                                disableOnInteraction: false,
                            },
                            navigation: {
                                nextEl: '.infografis-next',
                                prevEl: '.infografis-prev',
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                type: 'fraction',
                            },
                            on: {
                                slideChange: function () {
                                    const activeSlide = this.slides[this.activeIndex];
                                    const img = activeSlide ? activeSlide.querySelector('img') : null;
                                    if (img) {
                                        window.dispatchEvent(new CustomEvent('infografis-change', { 
                                            detail: { image: img.src } 
                                        }));
                                    }
                                },
                            },
                        });
                    }
                }

                document.addEventListener('livewire:navigated', initInfografisSwiper);
                document.addEventListener('DOMContentLoaded', initInfografisSwiper);
                if (document.readyState === 'complete' || document.readyState === 'interactive') {
                    initInfografisSwiper();
                }
            </script>
            @endpush
        @else
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center py-12">
                <div class="flex flex-col items-center justify-center text-center p-8 rounded-2xl border-2 border-dashed border-gray-700 bg-gray-800/30 max-w-md w-full text-gray-400">
                    <i class="bi bi-images text-6xl text-gray-600 mb-4"></i>
                    <p class="text-lg font-medium italic">Belum ada gambar tersedia</p>
                </div>
            </div>
        @endif
    </section>

    {{-- Gallery Section --}}
    {{-- Gallery Section --}}
    <livewire:gallery />

    {{-- Agenda & Pengumuman Section --}}
    <section id="agenda-pengumuman" class="py-12 bg-blue-50 dark:bg-zinc-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Agenda Section --}}
                <div class="lg:col-span-2">
                    <livewire:agenda />
                </div>

                {{-- Pengumuman Section --}}
                <div class="lg:col-span-1">
                    <livewire:home-pengumuman />
                </div>
            </div>
        </div>
    </section>

    {{-- External Links Section --}}
    <section id="external-links" class="pb-12 bg-white dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:external-links />
        </div>
    </section>
</div>
