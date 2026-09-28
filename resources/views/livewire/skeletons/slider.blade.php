<div class="relative w-full overflow-hidden animate-pulse">
    <!-- Hero Slider Skeleton -->
    <div class="relative h-[500px] w-full bg-gray-200 dark:bg-gray-700 rounded-2xl mb-8">
        <div class="absolute bottom-0 left-0 w-full p-8 space-y-4">
            <div class="h-4 w-24 bg-gray-300 dark:bg-gray-600 rounded"></div>
            <div class="h-8 w-3/4 bg-gray-300 dark:bg-gray-600 rounded"></div>
            <div class="h-8 w-1/2 bg-gray-300 dark:bg-gray-600 rounded"></div>
            <div class="flex gap-4 mt-4">
                <div class="h-10 w-32 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
            </div>
        </div>
        <!-- Thumbnails Right Side -->
        <div class="absolute right-4 top-1/2 -translate-y-1/2 hidden lg:flex flex-col gap-4">
            @for($i=0; $i<3; $i++)
                <div class="w-16 h-16 bg-gray-300 dark:bg-gray-600 rounded-lg">
        </div>
        @endfor
    </div>
</div>

<!-- Popular Posts Bar Skeleton -->
<div class="relative -mt-20 z-20 px-4 max-w-7xl mx-auto">
    <div class="flex gap-4 overflow-hidden">
        @for($i=0; $i<4; $i++)
            <div class="flex-shrink-0 w-[300px] h-24 bg-gray-200 dark:bg-gray-800 rounded-lg p-3 flex gap-3 border border-gray-200 dark:border-gray-700">
            <div class="w-24 h-full bg-gray-300 dark:bg-gray-700 rounded-md"></div>
            <div class="flex-1 space-y-2 py-1">
                <div class="h-3 w-16 bg-gray-300 dark:bg-gray-700 rounded"></div>
                <div class="h-4 w-full bg-gray-300 dark:bg-gray-700 rounded"></div>
                <div class="h-4 w-2/3 bg-gray-300 dark:bg-gray-700 rounded"></div>
            </div>
    </div>
    @endfor
</div>
</div>
</div>