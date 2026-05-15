<template>
    <Head title="Sejarah Pondok Pesantren" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-emerald-900 py-24 overflow-hidden">
            <div class="absolute inset-0 bg-dot-pattern opacity-20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 text-emerald-300 text-sm font-semibold mb-4 border border-emerald-700">
                    Perjalanan Pondok
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Sejarah Pondok
                </h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                    Perjalanan panjang Pondok Pesantren Riyadussalikin dalam mendidik dan mencetak generasi Qur'ani yang berakhlak mulia.
                </p>
            </div>
        </section>

        <!-- Timeline Section -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Ada data -->
                <div v-if="sejarahList && sejarahList.length > 0" class="relative">
                    <!-- Garis timeline -->
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-emerald-200 hidden md:block"></div>

                    <div class="space-y-10">
                        <div
                            v-for="(item, index) in sejarahList"
                            :key="item.id"
                            class="relative flex gap-6 items-start group"
                        >
                            <!-- Dot + Periode -->
                            <div class="flex-shrink-0 flex flex-col items-center">
                                <div class="w-16 h-16 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs text-center z-10 shadow-lg group-hover:bg-emerald-700 transition-colors leading-tight p-1">
                                    {{ item.periode || (index + 1) }}
                                </div>
                            </div>

                            <!-- Konten -->
                            <div class="card flex-1 hover:shadow-xl transition-all duration-300 group-hover:-translate-y-0.5">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ item.judul }}</h3>
                                <div
                                    class="text-gray-600 leading-relaxed text-sm prose prose-emerald max-w-none text-justify"
                                    v-html="item.konten"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Belum ada data -->
                <div v-else class="text-center py-20">
                    <div class="flex justify-center mb-4">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Data Sejarah Belum Tersedia</h3>
                    <p class="text-gray-500">Sejarah pondok pesantren akan segera ditampilkan di sini.</p>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-16 bg-emerald-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Jadilah Bagian dari Sejarah Kami</h2>
                <p class="text-emerald-100 mb-8 max-w-xl mx-auto">
                    Tuliskan sejarah Anda bersama Pondok Pesantren Riyadussalikin.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-white text-emerald-600 hover:bg-gray-50 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300 shadow-lg hover:shadow-xl">
                        SPMB
                    </a>
                    <Link :href="route('tentang-pondok')" class="bg-emerald-800 text-white hover:bg-emerald-900 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300">
                        Tentang Pondok
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    sejarahList: {
        type: Array,
        default: () => [],
    },
});
</script>
