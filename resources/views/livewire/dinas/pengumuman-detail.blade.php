<div class="py-12 bg-gray-50 dark:bg-zinc-900 min-h-screen transition-colors duration-200">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
            class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 dark:border-gray-700">
            <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white leading-snug">{{ $pengumuman->judul }}</h1>
            <div class="text-gray-600 dark:text-gray-400 mb-6 flex items-center text-sm">
                <i class="bi bi-calendar3 mr-2"></i>
                {{ $pengumuman->published_at ? $pengumuman->published_at->format('d M Y') : '' }}
            </div>

            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                {!! $pengumuman->isi !!}
            </div>

            @if ($pengumuman->lampiran)
                <div class="mt-10 border-t border-gray-100 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Lampiran</h3>
                    <a href="{{ asset('storage/' . $pengumuman->lampiran) }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                        <i class="bi bi-paperclip mr-2"></i> Unduh Lampiran
                    </a>
                </div>
            @endif

            <div class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-700">
                <a wire:navigate href="{{ route('pengumuman.index') }}"
                    class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors group">
                    <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Pengumuman
                </a>
            </div>

        </div>
    </div>
</div>
