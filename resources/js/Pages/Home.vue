<template>
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-emerald-50 via-white to-yellow-50 bg-pattern">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
                <div class="text-center">
                    <div class="mb-6">
                        <img src="/Logo Riyad.png" alt="Logo Riyadussalikin" class="h-24 w-24 mx-auto mb-4" />
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                        Pondok Pesantren <span class="text-gradient">Riyadussalikin</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-700 mb-4 font-arabic">
                        بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                    </p>
                    <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Membentuk Generasi Qur'ani yang Berakhlak Mulia, Berilmu, dan Mandiri
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://ppdb.riyadussalikin.sch.id" target="_blank" class="btn-primary inline-block">
                            Daftar PPDB
                        </a>
                        <Link :href="route('kontak')" class="btn-secondary inline-block">
                            Hubungi Kami
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="section-title">Tentang Kami</h2>
                    <p class="section-subtitle max-w-3xl mx-auto">
                        Pondok Pesantren Riyadussalikin Padaherang adalah lembaga pendidikan Islam yang berkomitmen untuk mencetak generasi yang beriman, berilmu, dan berakhlak mulia.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Keunggulan 1 -->
                    <div class="card text-center group hover:border-emerald-500 border-2 border-transparent">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pendidikan Berkualitas</h3>
                        <p class="text-gray-600">
                            Kurikulum terpadu yang menggabungkan pendidikan agama dan umum dengan metode pembelajaran modern.
                        </p>
                    </div>

                    <!-- Keunggulan 2 -->
                    <div class="card text-center group hover:border-emerald-500 border-2 border-transparent">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pembinaan Akhlak</h3>
                        <p class="text-gray-600">
                            Fokus pada pembentukan karakter islami yang kuat melalui bimbingan ustadz dan ustadzah yang berpengalaman.
                        </p>
                    </div>

                    <!-- Keunggulan 3 -->
                    <div class="card text-center group hover:border-emerald-500 border-2 border-transparent">
                        <div class="bg-emerald-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 transition-colors">
                            <svg class="w-8 h-8 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Fasilitas Lengkap</h3>
                        <p class="text-gray-600">
                            Asrama nyaman, masjid luas, perpustakaan, laboratorium, dan fasilitas olahraga yang memadai.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Prestasi Section -->
        <section v-if="prestasi.length > 0" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="section-title">Prestasi Terbaru</h2>
                    <p class="section-subtitle">
                        Pencapaian santri dan lembaga yang membanggakan
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="item in prestasi" :key="item.id" class="card">
                        <div class="flex items-start justify-between mb-3">
                            <span 
                                class="px-3 py-1 rounded-full text-xs font-semibold"
                                :class="{
                                    'bg-green-100 text-green-800': item.kategori === 'akademik',
                                    'bg-blue-100 text-blue-800': item.kategori === 'non_akademik',
                                    'bg-purple-100 text-purple-800': item.kategori === 'keagamaan'
                                }"
                            >
                                {{ item.kategori === 'akademik' ? 'Akademik' : item.kategori === 'non_akademik' ? 'Non-Akademik' : 'Keagamaan' }}
                            </span>
                            <span class="text-sm text-gray-500">{{ item.tahun }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ item.judul }}</h3>
                        <p class="text-sm text-emerald-600 font-semibold">{{ item.tingkat }}</p>
                        <p v-if="item.deskripsi" class="text-sm text-gray-600 mt-2">{{ item.deskripsi }}</p>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <Link :href="route('prestasi')" class="btn-primary inline-block">
                        Lihat Semua Prestasi
                    </Link>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-r from-emerald-600 to-emerald-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Bergabunglah Bersama Kami
                </h2>
                <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                    Daftarkan putra-putri Anda untuk menjadi bagian dari keluarga besar Pondok Pesantren Riyadussalikin
                </p>
                <a href="https://ppdb.riyadussalikin.sch.id" target="_blank" class="bg-white text-emerald-600 hover:bg-gray-50 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300 shadow-lg hover:shadow-xl">
                    Daftar Sekarang
                </a>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    prestasi: {
        type: Array,
        default: () => []
    }
});
</script>
