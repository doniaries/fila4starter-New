<div class="py-4 animate-pulse">
    {{-- Static Title to match real component --}}
    <div class="h-8 bg-gray-200 dark:bg-zinc-800 rounded w-48 mx-auto mb-8"></div>

    <div class="relative overflow-hidden">
        {{-- Gradient Masks (Static) --}}
        <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-white dark:from-zinc-900 to-transparent z-10"></div>
        <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-white dark:from-zinc-900 to-transparent z-10"></div>

        <div class="overflow-hidden py-4">
            {{-- Horizontal scrolling emulation --}}
            <div class="flex gap-6 overflow-hidden">
                @foreach (range(1, 5) as $i)
                <div class="flex flex-col items-center justify-center p-4 bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 w-48 h-40 mx-3 flex-shrink-0">
                    <div class="w-16 h-16 mb-3 rounded-full bg-gray-200 dark:bg-zinc-700"></div>
                    <div class="w-full px-2 space-y-2">
                        <div class="h-3 bg-gray-200 dark:bg-zinc-700 rounded w-full"></div>
                        <div class="h-3 bg-gray-200 dark:bg-zinc-700 rounded w-3/4 mx-auto"></div>
                    </div>
                </div>
                @endforeach
                {{-- Cutoff item --}}
                <div class="flex flex-col items-center justify-center p-4 bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 w-48 h-40 mx-3 flex-shrink-0 opacity-50">
                    <div class="w-16 h-16 mb-3 rounded-full bg-gray-200 dark:bg-zinc-700"></div>
                </div>
            </div>
        </div>
    </div>
</div>