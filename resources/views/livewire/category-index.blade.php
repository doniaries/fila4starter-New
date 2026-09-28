<div class="bg-gray-50 dark:bg-zinc-900 min-h-screen">
    @push('title', $pageTitle)
    @push('meta')
        <meta name="description" content="{{ $pageDescription }}">
    @endpush

    <x-page-header title="Kategori Berita" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Header & Introduction --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Temukan Topik Seputar Sijunjung</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Jelajahi berbagai berita dan informasi berdasarkan
                kategori yang tersedia di Website Resmi Dinas Pariwisata Pemuda dan Olahraga Kabupaten Sijunjung.</p>
        </div>

        {{-- Categories Grid --}}
        @if (isset($categories) && $categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                        class="group relative flex flex-col items-center justify-center p-6 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-gray-700 rounded-2xl hover:shadow-xl transition-all duration-300 hover:-translate-y-2 overflow-hidden text-center h-full">

                        <!-- Top Colored Border Indicator -->
                        <div class="absolute top-0 left-0 right-0 h-2 transition-all duration-300 group-hover:h-full opacity-80 group-hover:opacity-100"
                            style="background-color: {{ $bgColor }};"></div>

                        <!-- Content -->
                        <div
                            class="relative z-10 flex flex-col items-center w-full transition-colors duration-300 group-hover:{{ $textColor }}">

                            <!-- Icon/Tag Illustration -->
                            <div
                                class="w-16 h-16 rounded-full bg-gray-50 dark:bg-zinc-700 flex items-center justify-center mb-4 group-hover:bg-white/20 transition-colors">
                                <i class="bi bi-tag-fill text-2xl" style="color: {{ $bgColor }};"
                                    class="group-hover:text-inherit"></i>
                            </div>

                            <h3
                                class="font-bold text-lg text-gray-800 dark:text-gray-100 mb-2 group-hover:{{ $textColor }}">
                                {{ $category->name }}
                            </h3>

                            <div
                                class="inline-flex items-center justify-center px-4 py-1 mt-auto text-sm font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full group-hover:bg-white/20 group-hover:{{ $textColor }}">
                                <i class="bi bi-journals mr-2"></i> {{ $category->posts_count }} Berita
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $categories->links() }}
            </div>
        @else
            {{-- Empty State --}}
            <div
                class="text-center py-20 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <div
                    class="mx-auto w-24 h-24 bg-gray-100 dark:bg-zinc-700 rounded-full flex items-center justify-center mb-6">
                    <i class="bi bi-tags text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Kategori</h3>
                <p class="text-gray-500 dark:text-gray-400">Saat ini belum ada kategori berita yang tersedia atau
                    memiliki postingan aktif.</p>
                <div class="mt-8">
                    <a wire:navigate href="{{ route('home') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="bi bi-arrow-left mr-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
