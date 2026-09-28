<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach ($recentPosts as $post)
        <div
            class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 h-full flex flex-col group relative">
            <a wire:navigate.hover href="{{ route('berita.show', $post->slug) }}"
                class="before:absolute before:inset-0 z-10"></a>
            <div class="block relative aspect-video overflow-hidden">
                @if ($post->foto_utama)
                    <img src="{{ $post->foto_utama_url }}" alt="{{ $post->title }}" loading="lazy"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                        onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Image+Not+Found'">
                @else
                    <div
                        class="w-full h-full bg-gray-100 dark:bg-gray-800 flex flex-col items-center justify-center text-gray-400 dark:text-gray-500 transition-colors duration-300">
                        <i class="bi bi-image text-4xl mb-2 opacity-50"></i>
                        <span class="text-xs font-medium">Belum ada gambar tersedia</span>
                    </div>
                @endif

                @if ($post->source_link)
                    <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-sm p-1 rounded shadow-sm z-20"
                        title="Berita Saduran/Link Luar">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </div>
                @endif

                <div
                    class="absolute bottom-0 left-0 p-3 w-full bg-linear-to-t from-black/80 to-transparent z-20 flex flex-wrap gap-1.5">
                    @if ($post->tags && $post->tags->count() > 0)
                        @foreach ($post->tags as $tag)
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

                                $baseColor = $tag->color;
                                if (empty($baseColor)) {
                                    $colorIndex = $tag->id % count($fallbackColors);
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
                                class="inline-block px-2 py-1 text-[10px] font-semibold {{ $textColor }} rounded-md shadow-sm"
                                style="background-color: {{ $baseColor }}">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    @else
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-md shadow-sm"
                            style="background-color: #3b82f6">
                            Berita
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-5 flex-1 flex flex-col">
                <div class="flex items-start justify-between gap-3 mb-2">
                    <h3
                        class="text-lg font-bold text-gray-900 dark:text-white leading-tight line-clamp-1 md:line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors flex-1 relative z-20">
                        <a href="{{ route('berita.show', $post->slug) }}" class="block">{{ $post->title }}</a>
                    </h3>
                    <div
                        class="md:hidden shrink-0 bg-blue-600 group-hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-[10px] font-semibold shadow-md shadow-blue-500/20 transition-all duration-300 flex items-center gap-1.5 relative z-20">
                        Baca <i class="bi bi-arrow-right-short text-sm"></i>
                    </div>
                </div>



                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                    {{ Str::limit(strip_tags($post->content), 100) }}
                </p>

                <div
                    class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-3 text-gray-500 dark:text-gray-400">
                        <span
                            class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-700/50 px-2 py-1 rounded-md mb-0">
                            <i class="bi bi-calendar3"></i>
                            {{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : $post->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="flex items-center gap-1 text-gray-400" title="{{ $post->views ?? 0 }} Dilihat">
                            <i class="bi bi-eye"></i> {{ $post->views ?? 0 }}
                        </span>
                        <a wire:navigate href="{{ route('berita.show', $post->slug) }}"
                            class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                            Baca..
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
