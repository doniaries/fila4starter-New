<div class="bg-gray-50 dark:bg-gray-900 min-h-screen pb-12 transition-colors duration-200">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a wire:navigate href="{{ route('home') }}" class="inline-flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i class="bi bi-house-door-fill mr-2"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 text-xs mx-2"></i>
                        <a wire:navigate href="{{ route('ekraf.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Ekraf</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 text-xs mx-2"></i>
                        <span class="text-gray-800 dark:text-gray-200 font-medium truncate max-w-[200px]">{{ $ekraf->nama_pelaku }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mb-8">
            <!-- Header/Hero section -->
            <div class="relative h-64 md:h-96 w-full bg-gray-200 dark:bg-gray-700">
                @if ($ekraf->gambar)
                    <img src="{{ str_starts_with($ekraf->gambar, 'http') ? $ekraf->gambar : asset('storage/' . $ekraf->gambar) }}" alt="{{ $ekraf->nama_pelaku }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="bi bi-image text-6xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full">
                    @if($ekraf->kategoriEkraf)
                        <span class="inline-block px-3 py-1 mb-3 text-xs font-semibold text-white bg-blue-600 rounded-full shadow-lg">
                            {{ $ekraf->kategoriEkraf->nama }}
                        </span>
                    @endif
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 leading-tight">
                        {{ $ekraf->nama_pelaku }}
                    </h1>
                    @if($ekraf->kategori_usaha)
                        <p class="text-gray-200 flex items-center gap-2">
                            <i class="bi bi-briefcase-fill text-blue-400"></i> {{ $ekraf->kategori_usaha }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Content section -->
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left: Details -->
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2">Deskripsi</h2>
                            <div class="prose dark:prose-invert prose-blue max-w-none text-gray-600 dark:text-gray-300">
                                {!! $ekraf->deskripsi ?? 'Belum ada deskripsi.' !!}
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                            @if($ekraf->alamat)
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl">
                                    <div class="flex items-start gap-3">
                                        <i class="bi bi-geo-alt-fill text-blue-500 text-xl mt-1"></i>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $ekraf->alamat }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $ekraf->kecamatan ?? '' }}, {{ $ekraf->nagari ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($ekraf->no_hp)
                                <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <i class="bi bi-telephone-fill text-green-500 text-xl"></i>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Kontak</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $ekraf->no_hp }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Gallery if exists -->
                        @if(!empty($ekraf->gallery) && is_array($ekraf->gallery) && count($ekraf->gallery) > 0)
                            <div class="mt-8">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2">Galeri Foto</h2>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach($ekraf->gallery as $image)
                                        <a href="{{ asset('storage/' . $image) }}" target="_blank" class="block aspect-square rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 group">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Galeri" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right: Info Widget -->
                    <div class="md:col-span-1">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-5 rounded-2xl border border-blue-100 dark:border-blue-800/50 sticky top-24">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <i class="bi bi-info-circle-fill text-blue-500"></i> Informasi Tambahan
                            </h3>
                            
                            <ul class="space-y-4">
                                @if($ekraf->no_izin_usaha)
                                    <li>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Izin Usaha / NIB</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ekraf->no_izin_usaha }}</p>
                                    </li>
                                @endif
                                
                                @if($ekraf->no_haki)
                                    <li>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">HAKI</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ekraf->no_haki }}</p>
                                    </li>
                                @endif
                                
                                <li>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Tenaga Kerja</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        Total: {{ ($ekraf->jumlah_pekerja_pria ?? 0) + ($ekraf->jumlah_pekerja_wanita ?? 0) }} Orang
                                    </p>
                                </li>
                            </ul>
                            
                            <div class="mt-6 pt-6 border-t border-blue-200 dark:border-blue-800/50">
                                <p class="text-xs text-center text-gray-500 dark:text-gray-400">Terdaftar sejak {{ $ekraf->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Section -->
        @if($relatedPelaku->count() > 0)
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pelaku Ekraf Lainnya di Bidang {{ $ekraf->kategoriEkraf->nama }}</h2>
                    <a wire:navigate href="{{ route('ekraf.index', ['bidang' => $ekraf->kategoriEkraf->slug]) }}" class="text-blue-600 dark:text-blue-400 font-semibold text-sm hover:underline">Lihat Semua</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPelaku as $item)
                        <a wire:navigate href="{{ route('ekraf.show', $item->slug) }}" class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-md transition-all duration-300">
                            <div class="h-32 bg-gray-100 dark:bg-gray-700 relative overflow-hidden">
                                @if ($item->gambar)
                                    <img src="{{ str_starts_with($item->gambar, 'http') ? $item->gambar : asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_pelaku }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700">
                                        <i class="bi bi-image text-2xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm truncate group-hover:text-blue-600 transition-colors">{{ $item->nama_pelaku }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate">{{ $item->kategori_usaha ?? $item->kategoriEkraf->nama }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
