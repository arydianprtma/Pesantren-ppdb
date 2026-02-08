<x-filament-panels::page>
    <x-filament::section>
        <div class="flex flex-col items-center justify-center py-12 text-center">

            {{-- Menggunakan style inline untuk memastikan ukuran ikon tetap benar walau CSS belum di-rebuild --}}
            <div class="mb-6 rounded-full bg-gray-50 p-6 dark:bg-gray-800">
                <x-heroicon-o-clock class="text-primary-500" style="width: 64px; height: 64px;" />
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl mb-2">
                Segera Hadir
            </h2>

            <p class="mx-auto max-w-lg text-gray-500 dark:text-gray-400 mb-8 text-lg">
                Fitur <strong>{{ $this->getTitle() }}</strong> sedang dalam tahap pengembangan. <br>
                Nantikan pembaruan selanjutnya.
            </p>

            <div
                class="inline-flex items-center gap-2 rounded-lg bg-primary-50 px-4 py-2 text-sm font-medium text-primary-700 dark:bg-primary-900/50 dark:text-primary-300">
                <span class="relative flex h-3 w-3">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-primary-500"></span>
                </span>
                Dalam Proses Pengembangan
            </div>
        </div>
    </x-filament::section>
</x-filament-panels::page>