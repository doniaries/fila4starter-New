<div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full animate-pulse">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <div class="h-6 w-1 bg-gray-200 dark:bg-gray-700 rounded-full mr-3"></div>
            <div class="h-6 w-40 bg-gray-200 dark:bg-gray-700 rounded"></div>
        </div>
        <div class="h-4 w-24 bg-gray-200 dark:bg-gray-700 rounded"></div>
    </div>

    <div class="space-y-4">
        {{-- Table Header --}}
        <div class="h-10 w-full bg-gray-100 dark:bg-zinc-800 rounded mb-4"></div>

        {{-- Table Rows --}}
        @for($i=0; $i<5; $i++)
            <div class="flex items-center gap-4 py-3 border-b border-gray-50 dark:border-gray-800">
            <div class="w-1/5 space-y-2">
                <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-3 w-16 bg-gray-200 dark:bg-gray-700 rounded"></div>
            </div>
            <div class="w-2/5 space-y-2">
                <div class="h-4 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-3 w-32 bg-gray-200 dark:bg-gray-700 rounded"></div>
            </div>
            <div class="w-1/5 text-center">
                <div class="h-6 w-20 mx-auto bg-gray-200 dark:bg-gray-700 rounded-full"></div>
            </div>
            <div class="w-1/5 text-center">
                <div class="h-8 w-8 mx-auto bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
            </div>
    </div>
    @endfor
</div>
</div>