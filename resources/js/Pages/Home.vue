<template>
    <Head title="Beranda" />
    <MainLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-emerald-50 via-white to-emerald-50/30 overflow-hidden">
            <div class="absolute inset-0 bg-dot-pattern opacity-40"></div>
            <div class="container mx-auto px-4 pt-24 pb-20 relative z-10">
                <div class="text-center">
                    <div class="mb-6">
                        <img src="/Logo Riyad.png" alt="Logo Riyadussalikin" class="h-24 w-24 mx-auto mb-4" />
                    </div>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight tracking-tight">
                        Pondok Pesantren <span class="text-gradient">Riyadussalikin</span>
                    </h1>
                    <p class="text-xl md:text-2xl font-arabic text-emerald-700 mb-4">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Membentuk Generasi Qur'ani yang Berakhlak Mulia, Berilmu, dan Mandiri
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <a 
                                href="https://spmb.riyadussalikin.my.id/login" 
                                class="btn-primary w-full sm:w-auto text-center"
                            >
                                SPMB
                            </a>
                        <Link 
                            :href="route('kontak')" 
                            class="btn-secondary w-full sm:w-auto text-center"
                        >
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
                    <div v-if="visiMisi" class="section-subtitle max-w-3xl mx-auto prose prose-emerald" v-html="visiMisi.visi"></div>
                    <p v-else class="section-subtitle max-w-3xl mx-auto">
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
        <section v-if="prestasi.length > 0" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div class="text-left">
                        <h2 class="section-title !text-left !mb-2">Prestasi Terbaru</h2>
                        <p class="section-subtitle !text-left !mx-0">
                            Pencapaian santri dan lembaga yang membanggakan
                        </p>
                    </div>
                    <Link :href="route('prestasi')" class="text-emerald-600 font-bold hover:text-emerald-700 flex items-center gap-2 transition-colors">
                        Lihat Semua Prestasi
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="item in prestasi" :key="item.id" class="card overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                        <!-- Image -->
                        <div class="aspect-video overflow-hidden bg-gray-100 -mx-6 -mt-6 mb-4">
                            <img 
                                v-if="item.gambar"
                                :src="'/storage/' + item.gambar" 
                                :alt="item.judul"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            />
                            <div v-else class="w-full h-full flex items-center justify-center bg-emerald-50">
                                <svg class="w-12 h-12 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
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
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ item.judul }}</h3>
                        <div class="mt-auto">
                            <p class="text-sm text-emerald-600 font-semibold mb-2">{{ item.tingkat }}</p>
                            <p v-if="item.deskripsi" class="text-sm text-gray-600 line-clamp-2">{{ item.deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        <section v-if="beritaTerbaru.length > 0" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                    <div class="text-left">
                        <h2 class="section-title !text-left !mb-2">Berita & Kegiatan</h2>
                        <p class="section-subtitle !text-left !mx-0">
                            Ikuti terus kabar terbaru dan aktivitas di Pondok Pesantren
                        </p>
                    </div>
                    <Link :href="route('berita')" class="text-emerald-600 font-bold hover:text-emerald-700 flex items-center gap-2 transition-colors">
                        Lihat Semua Berita
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <Link 
                        v-for="berita in beritaTerbaru" 
                        :key="berita.id"
                        :href="route('berita.show', berita.slug)"
                        class="group"
                    >
                        <article class="card overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Image -->
                            <div class="aspect-video overflow-hidden bg-gray-100 -mx-6 -mt-6 mb-4">
                                <img 
                                    v-if="berita.gambar"
                                    :src="'/storage/' + berita.gambar" 
                                    :alt="berita.judul"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                />
                                <div v-else class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <span>{{ formatDate(berita.published_at) }}</span>
                                    <span>•</span>
                                    <span class="text-emerald-600 font-semibold uppercase tracking-wider text-xs">
                                        {{ berita.kategori }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-tight">
                                    {{ berita.judul }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed mb-4">
                                    {{ stripHtml(berita.konten) }}
                                </p>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <span class="text-sm font-bold text-emerald-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </Link>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-emerald-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Bergabunglah Bersama Kami
                </h2>
                <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                    Daftarkan putra-putri Anda untuk menjadi bagian dari keluarga besar Pondok Pesantren Riyadussalikin
                </p>
                <a href="https://spmb.riyadussalikin.my.id/login" class="bg-white text-emerald-600 hover:bg-gray-50 font-bold py-4 px-8 rounded-lg inline-block transition-all duration-300 shadow-lg hover:shadow-xl">
                    Daftar Sekarang
                </a>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    prestasi: {
        type: Array,
        default: () => []
    },
    visiMisi: {
        type: Object,
        default: null
    },
    beritaTerbaru: {
        type: Array,
        default: () => []
    }
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
};

const stripHtml = (html) => {
    if (!html) return '';
    return html.replace(/<[^>]*>?/gm, '').replace(/&nbsp;/g, ' ');
};
</script>
