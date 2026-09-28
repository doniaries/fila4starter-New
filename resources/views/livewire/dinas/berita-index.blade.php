<div class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200 min-h-screen relative">

    {{-- Content --}}
    <div>
        <x-page-header title="Berita" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="mb-6 flex items-center justify-between">
                        <p class="text-gray-600 dark:text-gray-400">{{ $posts->total() }} berita ditemukan</p>

                        {{-- Active Filter --}}
                        @if ($category)
                            <div class="mb-8">
                                <div class="animate-fade-in-up">
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-md text-sm bg-blue-50 text-blue-700 border border-blue-100">
                                        Kategori: <strong>{{ Str::title(str_replace('-', ' ', $category)) }}</strong>
                                        <a wire:navigate href="{{ route('berita.index') }}"
                                            class="ml-1 text-blue-400 hover:text-red-500 transition-colors"
                                            title="Hapus Filter">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($posts as $post)
                            <x-berita-card :post="$post" />
                        @empty
                            <div class="col-span-full text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ada berita yang ditemukan.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($posts->hasPages())
                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 border-l border-gray-100 dark:border-gray-700 pl-0 lg:pl-8">
                    <div class="sticky top-24">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-colors duration-200">
                            <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4 flex items-center">
                                <span class="w-1 h-6 bg-blue-600 rounded-full mr-3"></span>
                                Topik / Kategori Terkini
                            </h3>

                            <div class="flex flex-wrap gap-2">
                                @forelse($categories as $cat)
                                    @php
                                        $catName = $cat->name;
                                        $isActive = request()->query('category') === $cat->slug;

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

                                        // Determine base hex color
                                        $baseColor = $cat->color;
                                        if (empty($baseColor)) {
                                            $colorIndex = $cat->id % count($fallbackColors);
                                            $baseColor = $fallbackColors[$colorIndex];
                                        }

                                        // Color logic
                                        $hex = str_replace('#', '', $baseColor);
                                        $r = hexdec(substr($hex, 0, 2));
                                        $g = hexdec(substr($hex, 2, 2));
                                        $b = hexdec(substr($hex, 4, 2));
                                        $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;

                                        // Text color contrasts with background brightness
                                        $textColor = $brightness > 160 ? '#1f2937' : '#ffffff';
                                        $badgeColor = $brightness > 160 ? 'rgba(0,0,0,0.1)' : 'rgba(255,255,255,0.2)';
                                        $bgColor = '#' . $hex;

                                        // Active Style
                                        if ($isActive) {
                                            $style = "background-color: {$bgColor}; color: {$textColor}; transform: scale(1.05); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);";
                                        } else {
                                            $style = "background-color: {$bgColor}; color: {$textColor};";
                                        }
                                    @endphp
                                    <a wire:navigate href="{{ route('berita.index', ['category' => $cat->slug]) }}"
                                        class="inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-full transition-all duration-200 hover:opacity-90 hover:shadow-sm"
                                        style="{{ $style }}">
                                        {{ $catName }}
                                        <span class="ml-1.5 opacity-90 text-[10px] px-1.5 rounded-full"
                                            style="background-color: {{ $badgeColor }}">{{ $cat->posts_count }}</span>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum ada kategori.</p>
                                @endforelse
                            </div>

                            <!-- Info Widget -->
                            <!-- <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl p-5 border border-blue-100 dark:border-blue-900/50">
                            <h4 class="font-bold text-blue-800 dark:text-blue-200 mb-2 text-sm">Informasi</h4>
                            <p class="text-xs text-blue-600 dark:text-blue-300 leading-relaxed">
                                Gunakan filter topik di atas untuk menemukan berita berdasarkan kategori yang Anda minati.
                            </p>
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
