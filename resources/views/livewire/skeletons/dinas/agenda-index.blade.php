{{-- Agenda Index Skeleton - Using Global Components --}}
<x-skeleton.page-container>
    <x-skeleton.page-header />
    <x-skeleton.card-grid
        :count="6"
        columns="grid-cols-1 md:grid-cols-2 lg:grid-cols-3" />
</x-skeleton.page-container>