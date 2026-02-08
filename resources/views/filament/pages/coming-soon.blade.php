<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
        {{-- Icon Container --}}
        <div class="mb-8 relative group">
            <div
                class="absolute inset-0 bg-emerald-100 rounded-full animate-pulse opacity-50 blur-xl dark:bg-emerald-900/30">
            </div>
            <div
                class="relative bg-emerald-50 rounded-full p-8 shadow-sm border border-emerald-100 dark:bg-gray-800 dark:border-gray-700">
                <x-heroicon-o-beaker class="w-16 h-16 text-emerald-600 dark:text-emerald-400" />
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white mb-3">
            {{ $this->getTitle() }}
        </h1>

        {{-- Subtitle --}}
        <p class="text-xl font-medium text-gray-500 uppercase tracking-widest mb-6">
            Coming Soon
        </p>

        {{-- Description --}}
        <p class="text-gray-500 dark:text-gray-400 max-w-lg mb-10 leading-relaxed">
            Halaman ini sedang dalam tahap pengembangan. <br>
            Informasi lengkap akan segera tersedia.
        </p>

        {{-- Action Button --}}
        <x-filament::button tag="a" href="/" size="lg" color="success" icon="heroicon-m-arrow-left">
            Kembali ke Beranda
        </x-filament::button>
    </div>
</x-filament-panels::page>