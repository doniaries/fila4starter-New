{{-- Gallery Index Skeleton - Using Global Components --}}
<x-skeleton.page-container>
    <x-skeleton.page-header centered />
    <x-skeleton.card-grid
        :count="12"
        columns="grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
        imageHeight="h-64" />
</x-skeleton.page-container>