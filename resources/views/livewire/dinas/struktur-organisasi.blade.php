<div class="bg-gray-50 dark:bg-zinc-900 min-h-screen">
    @push('title', $pageTitle)
    @push('meta')
    <meta name="description" content="{{ $pageDescription }}">
    @endpush

    <x-page-header title="Struktur Organisasi" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Header Section --}}
        <div class="text-center mb-16">
            <span class="mt-4 inline-flex items-center px-5 py-2 rounded-full text-base font-medium bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-400/10 dark:text-blue-400 dark:ring-blue-400/30 shadow-sm">
                {{ $siteName }}
            </span>
        </div>

        {{-- Table Container --}}
        <div id="struktur-table-container" class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-700/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Nama Unit Kerja</th>
                            <th scope="col" class="px-6 py-4">Pimpinan</th>
                            <th scope="col" class="px-6 py-4">Foto Profil</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($strukturOrganisasi as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/30 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white uppercase">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="font-medium uppercase">{{ $item->pimpinan ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->name }}" class="viewer-trigger w-12 h-12 rounded-full object-cover shadow-sm border border-gray-200 dark:border-gray-700">
                                @else
                                    <img src="{{ asset('images/default-user.png') }}" alt="{{ $item->name }}" class="viewer-trigger w-12 h-12 rounded-full object-cover shadow-sm border border-gray-200 dark:border-gray-700">
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="bi bi-inbox text-3xl"></i>
                                    <p>Belum ada data struktur organisasi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css">
    <style>
        /* Add pointer cursor to images indicating they are clickable */
        .viewer-trigger {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .viewer-trigger:hover {
            transform: scale(1.05);
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const tableContainer = document.getElementById('struktur-table-container');
            if (tableContainer) {
                new Viewer(tableContainer, {
                    toolbar: {
                        zoomIn: 1,
                        zoomOut: 1,
                        oneToOne: 1,
                        reset: 1,
                        prev: 0,
                        play: 0,
                        next: 0,
                        rotateLeft: 0,
                        rotateRight: 0,
                        flipHorizontal: 0,
                        flipVertical: 0,
                    },
                    navbar: false,
                    title: false,
                    tooltip: true,
                    movable: true,
                    zoomable: true,
                    rotatable: false,
                    scalable: false,
                    transition: true,
                });
            }
        });
    </script>
    @endpush
</div>