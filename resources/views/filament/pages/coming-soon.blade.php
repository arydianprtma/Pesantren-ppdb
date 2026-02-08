<x-filament-panels::page>
    <div
        class="flex flex-col items-center justify-center p-8 text-center bg-white rounded-xl shadow-sm border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
        <div class="mb-6 p-4 bg-primary-50 rounded-full dark:bg-primary-900/20">
            <x-heroicon-o-clock class="w-16 h-16 text-primary-600 dark:text-primary-400" />
        </div>

        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
            Segera Hadir
        </h2>

        <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto mb-6">
            Fitur <strong>{{ $this->getTitle() }}</strong> sedang dalam tahap pengembangan dan akan segera tersedia
            untuk mengelola data pesantren.
        </p>

        <div
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary-700 bg-primary-50 rounded-lg dark:bg-primary-900/50 dark:text-primary-300">
            <div class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></div>
            Dalam Pengembangan
        </div>
    </div>
</x-filament-panels::page>