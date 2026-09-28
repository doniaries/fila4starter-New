@if ($links->count() > 0)
<div class="py-4">
    <h3 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-8">Tautan Eksternal</h3>

    <div class="relative overflow-hidden group">
        {{-- Gradient Masks --}}
        <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-white dark:from-zinc-900 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-white dark:from-zinc-900 to-transparent z-10 pointer-events-none"></div>

        <style>
            @keyframes marquee {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            .animate-marquee {
                display: flex;
                width: max-content;
                animation: marquee 40s linear infinite;
            }

            .group:hover .animate-marquee {
                animation-play-state: paused;
            }
        </style>

        <div class="overflow-hidden py-4">
            <div class="animate-marquee hover:pause gap-6">
                {{-- Loop 1 --}}
                @foreach ($links as $link)
                <a href="{{ Str::startsWith($link->url, ['http://', 'https://']) ? $link->url : 'https://' . $link->url }}" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center justify-center p-4 bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-300 w-48 h-40 group/item hover:scale-105 mx-3">

                    <div class="w-16 h-16 mb-3 rounded-full bg-gray-50 dark:bg-zinc-700 flex items-center justify-center p-2 group-hover/item:bg-blue-50 dark:group-hover/item:bg-blue-900/30 transition-colors">
                        @if (Str::startsWith($link->logo, 'fa-'))
                        <i class="{{ $link->logo }} text-3xl text-gray-600 dark:text-gray-400 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400"></i>
                        @elseif ($link->logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($link->logo) }}"
                            alt="{{ $link->nama_link }}"
                            class="w-full h-full object-contain transition-all duration-300"
                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($link->nama_link) }}&background=random';">
                        @else
                        <span class="text-xs font-bold text-blue-600">LINK</span>
                        @endif
                    </div>

                    <div class="text-center w-full px-2">
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-300 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400 line-clamp-2 leading-tight transition-colors">
                            {{ $link->nama_link }}
                        </p>
                    </div>
                </a>
                @endforeach

                {{-- Loop 2 --}}
                @foreach ($links as $link)
                <a href="{{ Str::startsWith($link->url, ['http://', 'https://']) ? $link->url : 'https://' . $link->url }}" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center justify-center p-4 bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-300 w-48 h-40 group/item hover:scale-105 mx-3">

                    <div class="w-16 h-16 mb-3 rounded-full bg-gray-50 dark:bg-zinc-700 flex items-center justify-center p-2 group-hover/item:bg-blue-50 dark:group-hover/item:bg-blue-900/30 transition-colors">
                        @if (Str::startsWith($link->logo, 'fa-'))
                        <i class="{{ $link->logo }} text-3xl text-gray-600 dark:text-gray-400 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400"></i>
                        @elseif ($link->logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($link->logo) }}"
                            alt="{{ $link->nama_link }}"
                            class="w-full h-full object-contain transition-all duration-300"
                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($link->nama_link) }}&background=random';">
                        @else
                        <span class="text-xs font-bold text-blue-600">LINK</span>
                        @endif
                    </div>

                    <div class="text-center w-full px-2">
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-300 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400 line-clamp-2 leading-tight transition-colors">
                            {{ $link->nama_link }}
                        </p>
                    </div>
                </a>
                @endforeach

                {{-- Loop 3 --}}
                @foreach ($links as $link)
                <a href="{{ Str::startsWith($link->url, ['http://', 'https://']) ? $link->url : 'https://' . $link->url }}" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center justify-center p-4 bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-300 w-48 h-40 group/item hover:scale-105 mx-3">

                    <div class="w-16 h-16 mb-3 rounded-full bg-gray-50 dark:bg-zinc-700 flex items-center justify-center p-2 group-hover/item:bg-blue-50 dark:group-hover/item:bg-blue-900/30 transition-colors">
                        @if (Str::startsWith($link->logo, 'fa-'))
                        <i class="{{ $link->logo }} text-3xl text-gray-600 dark:text-gray-400 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400"></i>
                        @elseif ($link->logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($link->logo) }}"
                            alt="{{ $link->nama_link }}"
                            class="w-full h-full object-contain transition-all duration-300"
                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($link->nama_link) }}&background=random';">
                        @else
                        <span class="text-xs font-bold text-blue-600">LINK</span>
                        @endif
                    </div>

                    <div class="text-center w-full px-2">
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-300 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400 line-clamp-2 leading-tight transition-colors">
                            {{ $link->nama_link }}
                        </p>
                    </div>
                </a>
                @endforeach

                {{-- Loop 4 --}}
                @foreach ($links as $link)
                <a href="{{ Str::startsWith($link->url, ['http://', 'https://']) ? $link->url : 'https://' . $link->url }}" target="_blank" rel="noopener noreferrer"
                    class="flex flex-col items-center justify-center p-4 bg-white dark:bg-zinc-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all duration-300 w-48 h-40 group/item hover:scale-105 mx-3">

                    <div class="w-16 h-16 mb-3 rounded-full bg-gray-50 dark:bg-zinc-700 flex items-center justify-center p-2 group-hover/item:bg-blue-50 dark:group-hover/item:bg-blue-900/30 transition-colors">
                        @if (Str::startsWith($link->logo, 'fa-'))
                        <i class="{{ $link->logo }} text-3xl text-gray-600 dark:text-gray-400 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400"></i>
                        @elseif ($link->logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($link->logo) }}"
                            alt="{{ $link->nama_link }}"
                            class="w-full h-full object-contain transition-all duration-300"
                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($link->nama_link) }}&background=random';">
                        @else
                        <span class="text-xs font-bold text-blue-600">LINK</span>
                        @endif
                    </div>

                    <div class="text-center w-full px-2">
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-300 group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400 line-clamp-2 leading-tight transition-colors">
                            {{ $link->nama_link }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif