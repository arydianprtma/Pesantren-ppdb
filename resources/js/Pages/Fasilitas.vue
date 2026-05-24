<template>
    <Head title="Fasilitas Pondok Pesantren" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-emerald-900 py-24 overflow-hidden">
            <div class="absolute inset-0 bg-dot-pattern opacity-20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 text-emerald-300 text-sm font-semibold mb-4 border border-emerald-700">
                    Sarana & Prasarana
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Fasilitas Pondok
                </h1>
                <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed">
                    Fasilitas lengkap yang mendukung proses belajar, ibadah, dan kehidupan sehari-hari santri Pondok Pesantren Riyadussalikin.
                </p>
            </div>
        </section>

        <!-- Fasilitas Grid -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Ada data -->
                <div v-if="fasilitasList && fasilitasList.length > 0">
                    
                    <!-- Category Filter -->
                    <div class="flex flex-wrap justify-center gap-2 mb-10">
                        <button
                            v-for="cat in categories"
                            :key="cat"
                            @click="selectedCategory = cat"
                            class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 border"
                            :class="selectedCategory === cat ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:border-emerald-300 hover:bg-emerald-50'"
                        >
                            {{ cat }}
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div
                            v-for="fasilitas in filteredFasilitas"
                            :key="fasilitas.id"
                            class="bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 group flex flex-col"
                        >
                            <!-- Cover Image -->
                            <div class="h-48 w-full bg-gray-200 relative overflow-hidden">
                                <img v-if="fasilitas.gambar" :src="`/storage/${fasilitas.gambar}`" :alt="fasilitas.nama" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                <div v-else class="w-full h-full bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" :d="getIkonPath(fasilitas.ikon)" />
                                    </svg>
                                </div>
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-xs px-3 py-1 rounded-full text-xs font-bold text-emerald-700 shadow-xs">
                                    {{ fasilitas.kategori || 'Fasilitas Umum' }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-emerald-100 text-emerald-600 p-2 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" :d="getIkonPath(fasilitas.ikon)" />
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-xl">{{ fasilitas.nama }}</h3>
                                </div>
                                <p v-if="fasilitas.deskripsi" class="text-sm text-gray-600 leading-relaxed">{{ fasilitas.deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Belum ada data -->
                <div v-else class="text-center py-20">
                    <div class="flex justify-center mb-4">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Data Fasilitas Belum Tersedia</h3>
                    <p class="text-gray-500">Fasilitas pondok akan segera ditampilkan di sini.</p>
                </div>
            </div>
        </section>

        <!-- Video Profil / Virtual Tour -->
        <section v-if="webSetting?.is_virtual_tour_active" class="py-20 bg-gray-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 0 L 100 100 L 0 100 Z" fill="#10b981" />
                </svg>
            </div>
            <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-block bg-emerald-900/50 text-emerald-400 border border-emerald-800 px-4 py-1 rounded-full text-sm font-semibold mb-6">
                    Virtual Tour
                </div>
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Jelajahi Pesantren Kami</h2>
                <p class="text-gray-400 mb-10 max-w-2xl mx-auto text-lg">
                    Saksikan video profil Pondok Pesantren Riyadussalikin untuk melihat lebih dekat lingkungan, fasilitas, dan kegiatan keseharian para santri.
                </p>
                
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group cursor-pointer max-w-4xl mx-auto border border-gray-800 bg-gray-800 aspect-video">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Video Thumbnail" loading="lazy" class="w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity duration-300" />
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 bg-emerald-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-emerald-900/50 group-hover:scale-110 group-hover:bg-emerald-500 transition-all duration-300">
                            <svg class="w-10 h-10 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-16 bg-emerald-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Tertarik Bergabung?</h2>
                <p class="text-emerald-100 mb-8 max-w-xl mx-auto">
                    Nikmati fasilitas lengkap Pondok Pesantren Riyadussalikin bersama ratusan santri lainnya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-white text-emerald-600 hover:bg-gray-50 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300 shadow-lg hover:shadow-xl">
                        SPMB
                    </a>
                    <Link :href="route('kontak')" class="bg-emerald-800 text-white hover:bg-emerald-900 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300">
                        Hubungi Kami
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import MainLayout from '../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    fasilitasList: {
        type: Array,
        default: () => [],
    },
    webSetting: {
        type: Object,
        default: () => ({}),
    },
});

const selectedCategory = ref('Semua');
const categories = ['Semua', 'Fasilitas Umum', 'Ibadah', 'Akademik', 'Asrama', 'Olahraga'];

const filteredFasilitas = computed(() => {
    if (selectedCategory.value === 'Semua') {
        return props.fasilitasList;
    }
    return props.fasilitasList.filter(f => (f.kategori || 'Fasilitas Umum') === selectedCategory.value);
});

const getIkonPath = (key) => {
    const paths = {
        masjid:       'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z',
        asrama:       'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
        kelas:        'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
        perpustakaan: 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
        komputer:     'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
        olahraga:     'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.25 9.71 2 12 2c2.291 0 4.545.25 6.75.721v1.515m0 0a48.667 48.667 0 00-1.5 1.185M18.75 4.236c.982.143 1.954.317 2.916.52a6.003 6.003 0 01-5.395 5.492m0 0H12',
        kantin:       'M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
        klinik:       'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 110s9-4.78 9-12z',
        lainnya:      'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21',
    };
    return paths[key] ?? paths.lainnya;
};
</script>
