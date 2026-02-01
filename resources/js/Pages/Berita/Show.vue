<template>
    <Head :title="berita.judul" />
    <MainLayout>
        <!-- Article Header -->
        <section class="bg-gradient-to-br from-emerald-50 via-white to-yellow-50 py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <nav class="mb-6">
                    <ol class="flex items-center gap-2 text-sm text-gray-500">
                        <li>
                            <Link :href="route('home')" class="hover:text-emerald-600">Beranda</Link>
                        </li>
                        <li>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </li>
                        <li>
                            <Link :href="route('berita')" class="hover:text-emerald-600">Berita</Link>
                        </li>
                        <li>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </li>
                        <li class="text-gray-700 font-medium truncate max-w-xs">{{ berita.judul }}</li>
                    </ol>
                </nav>

                <!-- Category & Date -->
                <div class="flex items-center gap-4 mb-4">
                    <span 
                        class="px-4 py-1.5 rounded-full text-sm font-semibold"
                        :class="{
                            'bg-emerald-100 text-emerald-800': berita.kategori === 'pengumuman',
                            'bg-blue-100 text-blue-800': berita.kategori === 'kegiatan',
                            'bg-purple-100 text-purple-800': berita.kategori === 'prestasi',
                            'bg-yellow-100 text-yellow-800': berita.kategori === 'umum'
                        }"
                    >
                        {{ formatKategori(berita.kategori) }}
                    </span>
                    <span class="text-gray-500">
                        {{ formatDate(berita.published_at) }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    {{ berita.judul }}
                </h1>
            </div>
        </section>

        <!-- Featured Image -->
        <section v-if="berita.gambar" class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img 
                        :src="'/storage/' + berita.gambar" 
                        :alt="berita.judul"
                        class="w-full h-auto max-h-[500px] object-cover"
                    />
                </div>
            </div>
        </section>

        <!-- Article Content -->
        <section class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <article class="prose prose-lg prose-emerald max-w-none">
                    <div v-html="berita.konten"></div>
                </article>

                <!-- Share Buttons -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Bagikan Berita Ini:</h3>
                    <div class="flex gap-3">
                        <a 
                            :href="'https://wa.me/?text=' + encodeURIComponent(berita.judul + ' - ' + currentUrl)"
                            target="_blank"
                            class="flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            WhatsApp
                        </a>
                        <a 
                            :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl)"
                            target="_blank"
                            class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                        <button
                            @click="copyLink"
                            class="flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            {{ copied ? 'Tersalin!' : 'Salin Link' }}
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Articles -->
        <section v-if="relatedBeritas.length > 0" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <Link 
                        v-for="related in relatedBeritas" 
                        :key="related.id"
                        :href="route('berita.show', related.slug)"
                        class="group"
                    >
                        <article class="card overflow-hidden hover:shadow-lg transition-shadow h-full">
                            <div class="aspect-video overflow-hidden bg-gray-100 -mx-6 -mt-6 mb-4">
                                <img 
                                    v-if="related.gambar"
                                    :src="'/storage/' + related.gambar" 
                                    :alt="related.judul"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                />
                            </div>
                            <h3 class="font-bold text-gray-900 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                {{ related.judul }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ formatDate(related.published_at) }}
                            </p>
                        </article>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Back to News -->
        <section class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <Link 
                    :href="route('berita')"
                    class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-semibold"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Berita
                </Link>
            </div>
        </section>
    </MainLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import { Link, Head, usePage } from '@inertiajs/vue3';

const props = defineProps({
    berita: {
        type: Object,
        required: true
    },
    relatedBeritas: {
        type: Array,
        default: () => []
    }
});

const page = usePage();
const copied = ref(false);

const currentUrl = computed(() => {
    return window.location.href;
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

const copyLink = async () => {
    try {
        await navigator.clipboard.writeText(currentUrl.value);
        copied.value = true;
        setTimeout(() => {
            copied.value = false;
        }, 2000);
    } catch (err) {
        console.error('Failed to copy:', err);
    }
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    color: #374151;
}

.prose h1, .prose h2, .prose h3, .prose h4 {
    color: #111827;
    font-weight: 700;
}

.prose a {
    color: #059669;
}

.prose img {
    border-radius: 0.75rem;
}

.prose blockquote {
    border-left-color: #059669;
    color: #4B5563;
}
</style>
