<div class="relative w-full overflow-hidden" wire:ignore x-data="{
    swiper: null,
    init() {
        this.initSwiper();
    },
    initSwiper() {
        if (this.swiper) {
            this.swiper.destroy(true, true);
        }

        const slideCount = {{ count($sliders) }};

        this.swiper = new Swiper(this.$refs.swiperContainer, {
            loop: slideCount > 1,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            preventClicks: false,
            preventClicksPropagation: false,
            touchStartPreventDefault: false,
            autoplay: slideCount > 0 ? {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            } : false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class=\'' + className + '\'>' + (index + 1) + '</span>';
                },
            },
        });
    }
}" x-init="init()">

    <div x-ref="swiperContainer" class="swiper w-full h-[500px] md:h-[450px] lg:h-[550px] bg-gray-900 relative z-10">
        <div class="swiper-wrapper">
            @foreach ($sliders as $index => $slider)
                <div class="swiper-slide relative flex items-center justify-center bg-gray-900">
                    {{-- Image --}}
                    @if ($slider->foto_utama_url)
                        @if ($index === 0)
                            @push('meta')
                                <link rel="preload" as="image" href="{{ $slider->foto_utama_url }}" fetchpriority="high">
                            @endpush
                        @endif
                        <img src="{{ $slider->foto_utama_url }}" alt="{{ $slider->title }}" width="1200"
                            height="600" class="absolute inset-0 w-full h-full object-cover"
                            @if ($index === 0) fetchpriority="high" @else loading="lazy" @endif
                            onerror="this.onerror=null; this.src='https://placehold.co/1200x600/1e293b/475569?text=Image+Not+Found'" />
                    @else
                        <div class="absolute inset-0 bg-linear-to-br from-gray-800 to-gray-900 w-full h-full"></div>
                    @endif

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-linear-to-t from-gray-900 via-gray-900/40 to-transparent"></div>

                    {{-- Content --}}
                    <div class="relative z-60 text-left px-4 md:px-8 lg:px-16 max-w-7xl mx-auto w-full mt-12 md:mt-20">

                        @if ($slider->categories && count($slider->categories) > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($slider->categories as $category)
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

                                        $hex = str_replace('#', '', $baseColor);
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));
                                        $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
                                        $textColor = $brightness > 160 ? 'text-gray-950' : 'text-white';
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-xs font-semibold {{ $textColor }} rounded-md shadow-lg backdrop-blur-sm"
                                        style="background-color: {{ $baseColor }}">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('berita.show', $slider->slug) }}" class="group block relative z-70">
                            <h2
                                class="text-lg md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-lg group-hover:text-blue-400 transition-colors duration-300 max-w-4xl line-clamp-2">
                                {{ $slider->title }}
                            </h2>
                        </a>

                        <a href="{{ route('berita.show', $slider->slug) }}"
                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 hover:-translate-y-1 hover:brightness-110 hover:shadow-xl hover:shadow-blue-500/40 text-white px-5 py-2.5 rounded-xl text-xs md:text-sm font-semibold gap-2 shadow-lg shadow-blue-500/30 transition-all duration-300 w-fit relative z-70 active:scale-95 group/btn">
                            <span>Baca Selengkapnya</span>
                            <i class="bi bi-arrow-right-circle group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>


                    </div>
                </div>
            @endforeach
        </div>

        {{-- Navigation Buttons --}}
        <div class="swiper-button-next text-white! opacity-70! hover:opacity-100! transition-opacity"
            aria-label="Slide Selanjutnya"></div>
        <div class="swiper-button-prev text-white! opacity-70! hover:opacity-100! transition-opacity"
            aria-label="Slide Sebelumnya"></div>

        {{-- Pagination with numbers --}}
        <div class="swiper-pagination"></div>

        {{-- Popular Posts Overlay (Bottom) --}}
        @if (isset($popularPosts) && $popularPosts->count() > 0)
            <div
                class="absolute bottom-0 left-0 right-0 z-80 bg-linear-to-t from-black/90 to-transparent pb-4 pt-12 pointer-events-none">
                <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
                    <h3 class="text-white font-bold text-lg mb-3 pointer-events-auto">Berita populer</h3>
                    <div
                        class="flex overflow-x-auto snap-x scrollbar-hide md:grid md:grid-cols-4 gap-3 pb-2 -mx-4 px-4 md:mx-0 md:px-0">
                        @foreach ($popularPosts as $post)
                            <a href="{{ route('berita.show', $post->slug) }}"
                                class="group flex shrink-0 w-[85%] sm:w-[300px] md:w-auto snap-center gap-2 bg-black/40 hover:bg-black/60 rounded-lg overflow-hidden transition-all duration-300 backdrop-blur-sm pointer-events-auto">
                                @if ($post->foto_utama_url)
                                    <img src="{{ $post->foto_utama_url }}" alt="{{ $post->title }}" width="64"
                                        height="64" class="w-16 h-16 object-cover shrink-0" loading="lazy"
                                        onerror="this.onerror=null; this.src='https://placehold.co/100x100/1e293b/ffffff?text=No+Image';">
                                @else
                                    <div class="w-16 h-16 bg-gray-700 flex items-center justify-center shrink-0">
                                        <i class="bi bi-image text-gray-400"></i>
                                    </div>
                                @endif
                                <div class="flex-1 py-1 pr-2 min-w-0">
                                    @if ($post->categories->isNotEmpty())
                                        @php
                                            $firstCat = $post->categories->first();

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

                                            $baseColor = $firstCat->color;
                                            if (empty($baseColor)) {
                                                $colorIndex = $firstCat->id % count($fallbackColors);
                                                $baseColor = $fallbackColors[$colorIndex];
                                            }

                                            $hex = str_replace('#', '', $baseColor);
                                            $r = hexdec(substr($hex, 0, 2));
                                            $g = hexdec(substr($hex, 2, 2));
                                            $b = hexdec(substr($hex, 4, 2));
                                            $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
                                            $textColor = $brightness > 160 ? 'text-gray-950' : 'text-white';
                                        @endphp
                                        <span
                                            class="inline-block px-2 py-0.5 text-[10px] font-semibold {{ $textColor }} rounded mb-1"
                                            style="background-color: {{ $baseColor }}">
                                            {{ $firstCat->name }}
                                        </span>
                                    @endif
                                    <h4
                                        class="text-white text-xs font-semibold line-clamp-2 group-hover:text-blue-300 transition-colors">
                                        {{ $post->title }}
                                    </h4>
                                    <p class="text-gray-400 text-[10px] mt-0.5">
                                        {{ $post->user->name ?? 'Admin' }} -
                                        {{ $post->published_at?->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>


    <!-- Alpine.js Slider Logic was moved to the root to prevent blocking -->

    <style>
        /* Custom pagination styling for numbered bullets */
        .swiper-pagination {
            bottom: 20px !important;
            /* Default bottom for mobile */
            right: 20px !important;
            left: auto !important;
            width: auto !important;
            z-index: 90 !important;
            /* Ensure it is above the popular posts overlay (z-80) */
            pointer-events: auto !important;
        }

        @media (min-width: 768px) {
            .swiper-pagination {
                bottom: 140px !important;
                /* Above popular posts on desktop */
            }
        }

        .swiper-pagination-bullet {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.3);
            opacity: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            margin: 0 4px !important;
        }

        .swiper-pagination-bullet-active {
            background: rgba(255, 255, 255, 0.9);
            color: #1e40af;
            transform: scale(1.1);
        }

        .swiper-pagination-bullet:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        /* Navigation buttons styling */
        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            background: rgba(0, 0, 0, 0.3) !important;
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px !important;
        }
    </style>
</div>
