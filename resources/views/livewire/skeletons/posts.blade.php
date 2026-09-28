<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-pulse">
    @for ($i = 0; $i < 6; $i++)
        <div class="bg-white dark:bg-zinc-800 rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col h-full">
        <!-- Image Skeleton -->
        <div class="block relative aspect-video bg-gray-200 dark:bg-gray-700"></div>

        <div class="p-6 flex flex-col flex-1">
            <!-- Categories Skeleton -->
            <div class="flex flex-wrap gap-2 mb-4">
                <div class="h-6 w-16 bg-gray-200 dark:bg-gray-700 rounded-md"></div>
                <div class="h-6 w-20 bg-gray-200 dark:bg-gray-700 rounded-md"></div>
            </div>

            <!-- Title Skeleton -->
            <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
            <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-2/3 mb-4"></div>

            <!-- Meta Skeleton -->
            <div class="mt-auto flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                    <div class="h-3 w-24 bg-gray-200 dark:bg-gray-700 rounded"></div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                    <div class="h-3 w-16 bg-gray-200 dark:bg-gray-700 rounded"></div>
                </div>
            </div>
        </div>
</div>
@endfor
</div>