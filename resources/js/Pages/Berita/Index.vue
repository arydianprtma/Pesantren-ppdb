<template>
    <Head title="Berita" />
    <MainLayout>
        <!-- Header Section -->
        <section class="bg-gradient-to-br from-emerald-50 via-white to-yellow-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Berita <span class="text-gradient">Terbaru</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Informasi dan kegiatan terbaru dari Pondok Pesantren Riyadussalikin
                    </p>
                </div>
            </div>
        </section>

        <!-- News Grid -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Empty State -->
                <div v-if="beritas.data.length === 0" class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-500">Berita akan segera ditampilkan di sini</p>
                </div>

                <!-- News Cards -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link 
                        v-for="berita in beritas.data" 
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
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <!-- Badge Baru -->
                                    <span 
                                        v-if="berita.is_new"
                                        class="px-2 py-0.5 rounded-full text-xs font-bold bg-red-500 text-white flex items-center gap-1"
                                    >
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        BARU
                                    </span>
                                    <span 
                                        class="px-3 py-1 rounded-full text-xs font-semibold"
                                        :class="{
                                            'bg-emerald-100 text-emerald-800': berita.kategori === 'pengumuman',
                                            'bg-blue-100 text-blue-800': berita.kategori === 'kegiatan',
                                            'bg-purple-100 text-purple-800': berita.kategori === 'prestasi',
                                            'bg-yellow-100 text-yellow-800': berita.kategori === 'umum'
                                        }"
                                    >
                                        {{ formatKategori(berita.kategori) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                                    <span>{{ formatDate(berita.published_at) }}</span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ berita.author_name }}
                                    </span>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                    {{ berita.judul }}
                                </h2>
                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {{ stripHtml(berita.konten) }}
                                </p>
                            </div>

                            <!-- Read More -->
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <span class="text-emerald-600 font-semibold text-sm group-hover:text-emerald-700 flex items-center gap-1">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </Link>
                </div>

                <!-- Pagination -->
                <div v-if="beritas.last_page > 1" class="mt-12 flex justify-center gap-2">
                    <Link 
                        v-for="page in beritas.last_page" 
                        :key="page"
                        :href="route('berita', { page })"
                        class="px-4 py-2 rounded-lg font-semibold transition-colors"
                        :class="page === beritas.current_page 
                            ? 'bg-emerald-600 text-white' 
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    >
                        {{ page }}
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    beritas: {
        type: Object,
        required: true
    }
});

const formatKategori = (kategori) => {
    const map = {
        'pengumuman': 'Pengumuman',
        'kegiatan': 'Kegiatan',
        'prestasi': 'Prestasi',
        'umum': 'Umum'
    };
    return map[kategori] || kategori;
};

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
};

const stripHtml = (html) => {
    if (!html) return '';
    const doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || '';
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
