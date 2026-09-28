@push('meta')
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}" />
    <meta property="og:image" content="{{ $post->foto_utama_url }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="{{ $post->title }}" />
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($post->content), 150) }}" />
    <meta property="twitter:image" content="{{ $post->foto_utama_url }}" />
@endpush

<div class="py-12 bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Featured Image -->
                <!-- Article Content -->
                <article class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900 dark:text-white leading-tight">
                        {{ $post->title }}</h1>

                    <!-- Meta Information -->
                    <div
                        class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <!-- Date -->
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Belum dipublikasi' }}</span>
                        </div>

                        <!-- Author -->
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $post->user->name ?? 'Admin' }}</span>
                        </div>

                        <!-- Editor -->
                        @php
                            $lastActivity = $post->activities()->where('description', 'updated')->latest()->first();
                            $editor = $lastActivity?->causer;
                        @endphp
                        @if ($editor)
                            <div class="flex items-center"
                                title="Terakhir diedit pada {{ $lastActivity->created_at->format('d M Y H:i') }}">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <span class="text-xs md:text-sm">Diedit: {{ $editor->name }}</span>
                            </div>
                        @endif

                        <!-- Views -->
                        @if (isset($post->views))
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>{{ number_format($post->views, 0, ',', '.') }} kali dilihat</span>
                            </div>
                        @endif

                        <!-- Category -->
                        @if ($post->tags && $post->tags->count() > 0)
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('berita.index', ['kategori' => $tag->slug]) }}"
                                            class="inline-block px-3 py-1 rounded-full text-white text-xs font-medium hover:brightness-110 transition-all"
                                            style="background-color: {{ $tag->color ?: '#3B82F6' }};">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>



                    <!-- Social Share Buttons -->
                    <div class="flex flex-wrap items-center gap-2 mb-8">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2">Bagikan:</span>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                            class="w-8 h-8 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-colors"
                            title="Share to Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <!-- Twitter / X -->
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($post->title) }}"
                            target="_blank"
                            class="w-8 h-8 rounded-full bg-black hover:bg-gray-800 text-white flex items-center justify-center transition-colors"
                            title="Share to X">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                            target="_blank"
                            class="w-8 h-8 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center transition-colors"
                            title="Share to WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                        <!-- Copy Link -->
                        <button
                            onclick="navigator.clipboard.writeText(window.location.href); alert('Link berhasil disalin!');"
                            class="w-8 h-8 rounded-full bg-gray-500 hover:bg-gray-600 text-white flex items-center justify-center transition-colors"
                            title="Copy Link">
                            <i class="bi bi-link-45deg"></i>
                        </button>
                    </div>

                    <!-- Featured Image (Moved Here) -->
                    @if ($post->foto_utama)
                        <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                            <div class="relative">
                                <img src="{{ $post->foto_utama_url }}" alt="{{ $post->title }}"
                                    class="w-full h-auto max-h-[500px] object-cover select-none"
                                    oncontextmenu="return false;" draggable="false"
                                    onerror="this.onerror=null; this.src='https://placehold.co/800x500/e2e8f0/64748b?text=Image+Not+Found'">

                                @if ($post->caption_foto_utama)
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/80 via-black/50 to-transparent p-4 pt-8">
                                        <p class="text-white text-sm md:text-base font-medium drop-shadow-lg"
                                            style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                                            {{ $post->caption_foto_utama }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div
                            class="mb-8 rounded-xl overflow-hidden shadow-lg h-64 bg-gray-200 dark:bg-gray-800 flex items-center justify-center">
                            <i class="bi bi-image text-6xl text-gray-400 dark:text-gray-600"></i>
                        </div>
                    @endif

                    <!-- Content -->
                    <div
                        class="prose prose-lg dark:prose-invert max-w-none 
                                text-gray-900 dark:text-gray-100
                                prose-headings:text-gray-900 dark:prose-headings:text-gray-100
                                prose-p:text-gray-900 dark:prose-p:text-gray-100
                                prose-a:text-blue-600 dark:prose-a:text-blue-400
                                prose-strong:text-gray-900 dark:prose-strong:text-gray-100
                                prose-li:text-gray-900 dark:prose-li:text-gray-100">
                        {!! $post->content !!}
                    </div>

                    @if ($post->source_link)
                        <div
                            class="mt-8 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600 flex items-start sm:items-center gap-3">
                            <div class="shrink-0 mt-1 sm:mt-0">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-0.5">Disadur dari sumber:</p>
                                <a href="{{ $post->source_link }}" target="_blank" rel="noopener noreferrer"
                                    class="text-blue-600 dark:text-blue-400 font-medium hover:underline truncate block"
                                    title="{{ $post->source_link }}">
                                    {{ $post->source_link }}
                                </a>
                            </div>
                            <div class="shrink-0">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </div>
                        </div>
                    @endif

                    <!-- Gallery Grid Section (Bottom) -->
                    @if (!empty($post->gallery) && count($post->gallery) > 0)
                        @php
                            // Support both old format (array of strings) and new format (array of objects)
                            $galleryItems = collect($post->gallery)
                                ->map(function ($item) {
                                    if (is_string($item)) {
                                        $item = ['image' => $item, 'caption' => null];
                                    }
                                    $item['url'] = \Illuminate\Support\Facades\Storage::disk('public')->url(
                                        $item['image'],
                                    );
                                    return $item;
                                })
                                ->toArray();
                        @endphp
                        <div x-data="{
                            lightboxOpen: false,
                            activeImage: '',
                            activeCaption: '',
                            currentIndex: 0,
                            items: {{ Js::from($galleryItems) }},
                            openLightbox(index) {
                                this.currentIndex = index;
                                this.activeImage = this.items[index].url;
                                this.activeCaption = this.items[index].caption || '';
                                this.lightboxOpen = true;
                                document.body.style.overflow = 'hidden';
                            },
                            closeLightbox() {
                                this.lightboxOpen = false;
                                document.body.style.overflow = '';
                            },
                            next() {
                                this.currentIndex = (this.currentIndex + 1) % this.items.length;
                                this.activeImage = this.items[this.currentIndex].url;
                                this.activeCaption = this.items[this.currentIndex].caption || '';
                            },
                            prev() {
                                this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
                                this.activeImage = this.items[this.currentIndex].url;
                                this.activeCaption = this.items[this.currentIndex].caption || '';
                            }
                        }" @keydown.escape.window="closeLightbox()"
                            @keydown.arrow-right.window="if(lightboxOpen) next()"
                            @keydown.arrow-left.window="if(lightboxOpen) prev()"
                            class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">

                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <i class="bi bi-images mr-3 text-blue-600"></i> Galeri Foto
                            </h3>

                            <!-- Thumbnail Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach ($galleryItems as $index => $item)
                                    <div class="group relative rounded-lg overflow-hidden cursor-pointer shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200 dark:border-gray-700"
                                        @click="openLightbox({{ $loop->index }})">
                                        <div class="aspect-square relative">
                                            <img src="{{ $item['url'] }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500 select-none"
                                                oncontextmenu="return false;" draggable="false"
                                                onerror="this.onerror=null; this.src='https://placehold.co/400x400/e2e8f0/64748b?text=Image'"
                                                alt="{{ $item['caption'] ?? 'Galeri foto' }}">
                                            <div
                                                class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                                <div
                                                    class="opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center shadow-lg">
                                                    <i class="bi bi-zoom-in text-gray-800 text-base"></i>
                                                </div>
                                            </div>

                                            @if (!empty($item['caption']))
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-2 pt-6">
                                                    <p class="text-white text-xs font-medium line-clamp-2 drop-shadow-lg"
                                                        style="text-shadow: 1px 1px 3px rgba(0,0,0,0.9);">
                                                        {{ $item['caption'] }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Lightbox Modal -->
                            <template x-teleport="body">
                                <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 z-50 grid place-items-center bg-black/90 backdrop-blur-sm p-4"
                                    style="display: none;">

                                    <!-- Close Button -->
                                    <button @click="closeLightbox()"
                                        class="absolute top-4 right-4 text-white hover:text-gray-300 z-50 p-2 focus:outline-none transition-colors">
                                        <i class="bi bi-x-lg text-2xl"></i>
                                    </button>

                                    <!-- Navigation Buttons -->
                                    <button @click.stop="prev()"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-white/80 z-60 p-3 md:p-4 focus:outline-none transition-all bg-black/40 hover:bg-black/80 rounded-full"
                                        x-show="items.length > 1">
                                        <i class="bi bi-chevron-left text-3xl md:text-5xl drop-shadow-lg"></i>
                                    </button>

                                    <button @click.stop="next()"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-white/80 z-60 p-3 md:p-4 focus:outline-none transition-all bg-black/40 hover:bg-black/80 rounded-full"
                                        x-show="items.length > 1">
                                        <i class="bi bi-chevron-right text-3xl md:text-5xl drop-shadow-lg"></i>
                                    </button>

                                    <!-- Image Container -->
                                    <div class="relative w-full h-full flex flex-col items-center justify-center p-4 md:p-10 pointer-events-none"
                                        @click.outside="closeLightbox()">
                                        <div class="relative">
                                            <img :src="activeImage"
                                                class="max-w-[90vw] max-h-[65vh] md:max-w-[75vw] md:max-h-[55vh] object-contain rounded-lg shadow-2xl pointer-events-auto mx-auto select-none"
                                                oncontextmenu="return false;" draggable="false"
                                                alt="Gallery Preview">
                                        </div>

                                        <!-- Caption -->
                                        <div x-show="activeCaption" class="mt-4 max-w-3xl pointer-events-auto">
                                            <p class="text-white text-center text-sm md:text-base font-medium bg-black/70 backdrop-blur-md px-6 py-3 rounded-lg border border-white/20 drop-shadow-2xl"
                                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.9);"
                                                x-text="activeCaption"></p>
                                        </div>

                                        <!-- Counter -->
                                        <div
                                            class="absolute -bottom-12 left-1/2 -translate-x-1/2 text-white/90 bg-black/60 backdrop-blur-md px-4 py-1.5 rounded-full text-sm font-medium border border-white/10 pointer-events-auto">
                                            <span x-text="currentIndex + 1"></span> / <span
                                                x-text="items.length"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a wire:navigate href="{{ route('berita.index') }}"
                            class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Related News Widget -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 sticky top-24 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 border-l-4 border-blue-600 pl-3">
                        Berita Terkait
                    </h3>

                    <div class="space-y-6">
                        @forelse($relatedPosts as $related)
                            <div class="group flex gap-4">
                                <!-- Thumbnail -->
                                <a wire:navigate href="{{ route('berita.show', $related->slug) }}"
                                    class="shrink-0 w-20 h-20 rounded-lg overflow-hidden relative">
                                    @if ($related->source_link)
                                        <div class="absolute top-1 right-1 bg-black/60 backdrop-blur-sm p-0.5 rounded shadow-sm z-10"
                                            title="Berita Saduran/Link Luar">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </div>
                                    @endif

                                    @if ($related->foto_utama)
                                        <img src="{{ $related->foto_utama_url }}" alt="{{ $related->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            onerror="this.src='https://placehold.co/100x100/e2e8f0/64748b?text=News'">
                                    @else
                                        <div
                                            class="w-full h-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                        {{ $related->published_at->format('d M Y') }}
                                    </div>
                                    <div class="flex flex-wrap gap-1 mb-1.5">
                                        @if ($related->tags && $related->tags->count() > 0)
                                            @foreach ($related->tags as $tag)
                                                <span
                                                    class="inline-block px-1.5 py-0.5 text-[10px] font-medium text-white rounded"
                                                    style="background-color: {{ $tag->color ?: '#3b82f6' }}">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <h4
                                        class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        <a wire:navigate href="{{ route('berita.show', $related->slug) }}">
                                            {{ $related->title }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <p>Tidak ada berita terkait saat ini.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-center">
                        <a wire:navigate href="{{ route('berita.index') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                            Lihat Semua Berita <i class="bi bi-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
