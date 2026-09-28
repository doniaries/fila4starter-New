<div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 h-full flex flex-col animate-pulse">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <div class="h-6 w-1 bg-gray-200 dark:bg-gray-700 rounded-full mr-3"></div>
            <div class="h-6 w-32 bg-gray-200 dark:bg-gray-700 rounded"></div>
        </div>
        <div class="h-4 w-20 bg-gray-200 dark:bg-gray-700 rounded"></div>
    </div>

    <div class="flex-1 space-y-4">
        @for($i=0; $i<3; $i++)
            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                </div>
                <div class="ml-4 flex-1 space-y-2">
                    <div class="h-3 w-24 bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="h-5 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="h-4 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                    <div class="h-3 w-32 bg-gray-200 dark:bg-gray-700 rounded"></div>
                </div>
            </div>
    </div>
    @endfor
</div>
</div>