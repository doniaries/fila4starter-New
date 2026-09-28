<div class="space-y-4">
    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Statistik Pengunjung</h4>

    <div class="grid grid-cols-2 gap-3">
        {{-- Hari Ini --}}
        <div class="p-3 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Hari Ini</div>
            <div class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($today ?? 0) }}</div>
        </div>

        {{-- Bulan Ini --}}
        <div class="p-3 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Bulan Ini</div>
            <div class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($month ?? 0) }}</div>
        </div>

        {{-- Online --}}
        <div class="p-3 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs text-green-600 dark:text-green-400 font-medium mb-1 flex items-center">
                        <span class="relative flex h-2 w-2 mr-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        Sedang Online
                    </div>
                    <div class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($online ?? 0) }}</div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">IP Anda</div>
                    <div class="text-xs font-mono text-gray-700 dark:text-gray-300" title="{{ $ip }}">{{ $ip }}</div>
                </div>
            </div>
        </div>
    </div>
</div>