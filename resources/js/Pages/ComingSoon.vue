<template>
    <Head title="Coming Soon" />
    <MainLayout>
        <div class="min-h-[70vh] flex flex-col items-center justify-center bg-gray-50 px-4">
            <div class="text-center max-w-2xl mx-auto">
                <div class="mb-8 relative mx-auto w-32 h-32 flex items-center justify-center bg-emerald-100 rounded-full animate-pulse">
                    <svg class="w-16 h-16 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight">
                    {{ title }}
                </h1>
                
                <div class="space-y-4">
                    <p class="text-xl text-gray-600 font-medium">Coming Soon</p>
                    <p class="text-gray-500">
                        Halaman ini sedang dalam tahap pengembangan.<br>
                        Informasi lengkap akan segera tersedia.
                    </p>
                </div>

                <div class="mt-10">
                    <Link 
                        :href="route('home')" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-semibold shadow-md hover:shadow-lg"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </Link>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '../Layouts/MainLayout.vue';

defineProps({
    title: {
        type: String,
        default: 'Halaman Segera Hadir'
    }
});
</script>
